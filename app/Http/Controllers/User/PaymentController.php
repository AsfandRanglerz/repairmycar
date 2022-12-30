<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Jobs\Notification;
use App\Models\InsuranceRequest;
use App\Models\Order;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\UserBid;
use App\Models\Vendor;
use App\Models\VendorBid;
use App\Models\webNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use TelrGateway\TelrManager;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $type = $request->type;
        $page_title = "payment";
        $vendorbid = VendorBid::with('vendordetail')->where('id', '=', $request->bid_id)->first();
        return view('user.payment.payment', compact('page_title', 'vendorbid', 'type'));
    }

    /** Insurance Conpany or Customer pay payment through the Check */
    public function throughCheck(Request $request)
    {
        $request->validate([
            'cheque_image' => 'required',
        ]);

        $amount = explode(" ", $request->amount);

        $order = Order::where([['user_bid_id', $request->user_bid_id], ['vendor_bid_id', $request->vendor_bid_id]])->first();
        $order->status = "complete";
        if ($request->file('cheque_image')) {
            $name = time() . '.' . $request->file('cheque_image')->getClientOriginalExtension();
            $name = $request->file('cheque_image')->move('public/image/profile/', $name);
            if (isset($order['cheque_image'])) {
                $order['cheque_image'] = $name . ',' . $order['cheque_image'];
            } else {
                $order['cheque_image'] = $name;
            }
        }
        $order->save();

        $vendorbid = VendorBid::with('vendordetail')->find($request->vendor_bid_id);

        $vendor = Vendor::find($vendorbid->vendordetail->vendor_id);
        $vendor->balance = $vendor->balance + $order->total;
        $vendor->save();
        // notification content
        $message['title'] = "Payment Completed";
        $message['order_no'] = $order->order_code;
        $message['order_id'] = $order->id;
        $message['body1'] = "We have received full payment on your ";
        $message['body2'] = "We want to thank you for choosing our services, it has been our pleasure to have you as a valued customer. Please don’t forget to download your invoice for your record, and rate the service that you have received from your garage.";
        $message['link1'] = url('user/order/summary', $order->id);
        $message['type'] = "order";
        $message['email'] = auth()->user()->email;
        $message['invoice'] = "quote";
        $message['paid_type'] = "order";
        $message['user'] = $order->paid_by;
        $message['total'] = $order->total;
        $message['paid'] = $amount[0];
        //mail notification to user
        $Notification = new Notification($message);
        dispatch($Notification);

        //web notification to vendor
        $notification = new webNotification();
        $notification->vendor_id = $vendorbid->vendordetail->vendor_id;
        $notification->title = auth()->user()->name . " Confirm to completed the order and release the payment, Order#" . $order->order_code;
        $notification->links = url('vendor/fullfillment', $order->id);
        $notification->body = ' ';
        $notification->save();

        $_SESSION["msg"] = "Order Completed and Payment Successfully Added";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.order.index');

    }

    /** Insurance Conpany or Customer pay payment through the credit card  when place order or completed */
    public function orderPlace(Request $request)
    {
        $amount = explode(" ", $request->amount);

        /**Temprary data store which use after payment process*/
        $value['user_bid_id'] = $request->user_bid_id;
        $value['vendor_bid_id'] = $request->vendor_bid_id;
        $value['garage_id'] = $request->garage_id;
        $value['net_total'] = $request->net_total;
        $value['amount'] = $amount[0];
        $value['type'] = $request->type;
        $data = TransactionDetail::find(1);
        $data->body = serialize($value);
        $data->save();

        /**update rerurn route which use after payment process*/
        config(['telr.create.return_auth' => '/user/order-payment/success']);
        config(['telr.create.return_can' => '/user/order-payment/cancel']);
        config(['telr.create.return_decl' => '/user/order-payment/declined']);
        $fp = fopen(base_path() . '/config/telr.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('telr'), true) . ';');
        fclose($fp);
        Artisan::call('cache:clear');

        /**payment process */
        $telrManager = new TelrManager();
        $order_id = rand(11111, 99999);
        $total = $amount[0];
        $billingParams = [
            'first_name' => Auth::guard('web')->user()->name,
            // 'sur_name' => ' ',
            'address_1' => Auth::guard('web')->user()->address,
            'city' => Auth::guard('web')->user()->city,
            'country' => 'AE',
            'email' => Auth::guard('web')->user()->email,
        ];
        return $telrManager->pay($order_id, $total, 'payment for the order confirmation', $billingParams)->redirect();
    }

    public function paymentSuccess(Request $request)
    {
        $data = TransactionDetail::find(1);
        $data = unserialize($data->body);

        if ($data['type'] == 'quote') {
            $order = new Order();
            $order_no = mt_rand('1000', '100000');
            $order->order_code = $order_no;
            $order->user_bid_id = $data['user_bid_id'];
            $order->vendor_bid_id = $data['vendor_bid_id'];
            $order->garage_id = $data['garage_id'];
            $order->total = $data['net_total'];
            $order->advance = $data['amount'];
            $order->customer_name = Auth::user()->name;
            $order->customer_address = Auth::user()->address;
            $order->customer_postal_code = Auth::user()->post_box;
            $order->customer_city = Auth::user()->city;
            $order->paid_by = "customer";
            $order->save();

            /** after order confirm update quote status */
            $quote = UserBid::find($data['user_bid_id']);
            $quote->offer_status = "ordered";
            $quote->save();

            /** notification content */
            $message['title'] = "Order Placement Completion";
            $message['order_no'] = $order_no;
            $message['order_id'] = $order->id;
            $message['body1'] = "Your ";
            $message['body2'] = "has been successfully placed. Your selected garage/ service provider will be starting the work soon. To stay updated on the status of your order please sign in to your account or stay tuned as we will communicate to you once the job is completed.";
            $message['link1'] = url('user/order/summary', $order->id);
            $message['type'] = "order";
            $message['email'] = auth()->user()->email;
            $message['invoice'] = "quote";
            $message['paid_type'] = "quote";
            $message['user'] = 'customer';
            $message['total'] = $data['net_total'];
            $message['paid'] = $data['amount'];
            /** mail notification to user */
            $Notification = new Notification($message);
            dispatch($Notification);

            /**  web  or mail notification to the vendor */
            $vendorbid = VendorBid::with('vendordetail')->find($data['vendor_bid_id']);
            $vendor = Vendor::find($vendorbid->vendordetail->vendor_id);

            $message['title'] = "Order Placement";
            $message['order_no'] = $order_no;
            $message['order_id'] = $order->id;
            $message['body1'] = Auth::user()->name . " placed ";
            $message['body2'] = "successfully to you.";
            $message['link1'] = url('vendor/fullfillment', $order->id);
            $message['type'] = "order";
            $message['email'] = $vendor->email;

            $gettime = strtotime($vendor->online_status) + 10;
            $now = strtotime(Carbon::now());
            if ($now > $gettime) {
                $Notification = new Notification($message);
                dispatch($Notification);
            } else {
                $notification = new webNotification();
                $notification->vendor_id = $vendorbid->vendordetail->vendor_id;
                $notification->title = auth()->user()->name . " accepted your quote and placed an Order #" . $order_no;
                $notification->links = url('vendor/fullfillment', $order->id);
                $notification->body = ' ';
                $notification->save();
            }

            $_SESSION["msg"] = "Order placed and Payment Successfully Added";
            $_SESSION["alert"] = "success";

        } else {
            /**change order status as completed */
            $order = Order::where([['user_bid_id', $data['user_bid_id']], ['vendor_bid_id', $data['vendor_bid_id']]])->first();
            $order->status = "complete";
            $order->save();

            // $vendorbid = VendorBid::with('vendordetail')->find($data['vendor_bid_id']);

            $vendor = Vendor::find($order->garage->vendor_id);
            $vendor->balance = $vendor->balance + $order->total;
            $vendor->save();
            /**  notification content */
            $message['title'] = "Payment Completed";
            $message['order_no'] = $order->order_code;
            $message['order_id'] = $order->id;
            $message['body1'] = "We have received full payment on your ";
            $message['body2'] = "We want to thank you for choosing our services, it has been our pleasure to have you as a valued customer. Please don’t forget to download your invoice for your record, and rate the service that you have received from your garage.";
            $message['link1'] = url('user/order/summary', $order->id);
            $message['type'] = "order";
            $message['email'] = auth()->user()->email;
            $message['invoice'] = "quote";
            $message['paid_type'] = "order";
            $message['user'] = $order->paid_by;
            $message['total'] = $order->total;
            $message['paid'] = $data['amount'];
            /** mail notification to user*/
            $Notification = new Notification($message);
            dispatch($Notification);

            /** web notification to vendor */
            $notification = new webNotification();
            $notification->vendor_id = $order->garage->vendor_id;
            $notification->title = auth()->user()->name . " Confirm to completed the order and release the payment, Order#" . $order->order_code;
            $notification->links = url('vendor/fullfillment', $order->id);
            $notification->body = ' ';
            $notification->save();

            $_SESSION["msg"] = "Order Completed and Payment Successfully Added";
            $_SESSION["alert"] = "success";
        }
        return redirect()->route('user.order.index');
    }

    public function paymentCancel(Request $request)
    {
        $data = TransactionDetail::find(1);
        $data = unserialize($data->body);

        $type = $data['type'];
        $page_title = "payment";
        $vendorbid = VendorBid::with('vendordetail')->where('id', '=', $data['vendor_bid_id'])->first();

        $_SESSION["msg"] = "Your request has been Cancelled";
        $_SESSION["alert"] = "success";
        return view('user.payment.payment', compact('page_title', 'vendorbid', 'type'));
    }

    public function paymentDeclined(Request $request)
    {
        $data = TransactionDetail::find(1);
        $data = unserialize($data->body);

        $type = $data['type'];
        $page_title = "payment";
        $vendorbid = VendorBid::with('vendordetail')->where('id', '=', $data['vendor_bid_id'])->first();

        $_SESSION["msg"] = "Your request has been Declined";
        $_SESSION["alert"] = "success";
        return view('user.payment.payment', compact('page_title', 'vendorbid', 'type'));

    }

    /** Insurance company place order for himself and pay when order is completed */
    public function orderPlaceByCompany(Request $request)
    {
        // return $request;
        $order = new Order();
        $order_no = mt_rand('1000', '100000');
        $order->order_code = $order_no;
        $order->user_bid_id = $request->user_bid_id;
        $order->vendor_bid_id = $request->vendor_bid_id;
        $order->garage_id = $request->garage_id;
        $order->total = $request->net_total;
        // $order->advance = $amount[0];
        $order->customer_name = Auth::user()->name;
        $order->customer_address = Auth::user()->address;
        $order->customer_postal_code = Auth::user()->post_box;
        $order->customer_city = Auth::user()->city;
        $order->paid_by = "company";
        $order->save();

        //after order confirm update quote status
        $quote = UserBid::find($request->user_bid_id);
        $quote->offer_status = "ordered";
        $quote->save();

        // notification content
        $message['title'] = "Order Placement Completion";
        $message['order_no'] = $order_no;
        $message['order_id'] = $order->id;
        $message['body1'] = "Your ";
        $message['body2'] = "has been successfully placed. Your selected garage/ service provider will be starting the work soon. To stay updated on the status of your order please sign in to your account or stay tuned as we will communicate to you once the job is completed.";
        $message['link1'] = url('user/order/summary', $order->id);
        $message['type'] = "order";
        $message['email'] = auth()->user()->email;
        //mail notification to user
        $Notification = new Notification($message);
        dispatch($Notification);

        // web  or mail notification to the vendor
        $vendorbid = VendorBid::with('vendordetail')->find($request->vendor_bid_id);
        $vendor = Vendor::find($vendorbid->vendordetail->vendor_id);

        $message['title'] = "Order Placement";
        $message['order_no'] = $order_no;
        $message['order_id'] = $order->id;
        $message['body1'] = Auth::user()->name . " placed ";
        $message['body2'] = "successfully to you.";
        $message['link1'] = url('vendor/fullfillment', $order->id);
        $message['type'] = "order";
        $message['email'] = $vendor->email;

        $gettime = strtotime($vendor->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->vendor_id = $vendorbid->vendordetail->vendor_id;
            $notification->title = auth()->user()->name . " accepted your quote and placed an Order #" . $order_no;
            $notification->links = url('vendor/fullfillment', $order->id);
            $notification->body = ' ';
            $notification->save();
        }

        $_SESSION["msg"] = "Your Order placed Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.order.index');
    }

    /** Customer place order on the behalf of his Insurance company */
    public function orderPlaceForInsurance($id)
    {

        $company = User::with('company')->find(Auth::id());

        $vendor_bid_id = $id;
        $company_id = $company->company[0]->id;

        $data = new InsuranceRequest();
        $data->company_id = $company_id;
        $data->customer_id = Auth::id();
        $data->vendor_bid_id = $vendor_bid_id;
        // $data->payment = $request->payment;
        $data->save();

        $bid = VendorBid::find($vendor_bid_id);

        $order = new Order();
        $order_no = mt_rand('1000', '100000');
        $order->order_code = $order_no;
        $order->user_bid_id = $bid->user_bid_id;
        $order->vendor_bid_id = $vendor_bid_id;
        $order->garage_id = $bid->garage_id;
        $order->total = $bid->net_total;
        $order->customer_name = Auth::user()->name;
        $order->customer_address = Auth::user()->address;
        $order->customer_postal_code = Auth::user()->post_box;
        $order->customer_city = Auth::user()->city;
        $order->paid_by = "insurance";
        $order->save();

        //after order confirm update quote status
        $quote = UserBid::find($bid->user_bid_id);
        $quote->offer_status = "ordered";
        $quote->save();

        //mail notification to customer
        $message['title'] = "Placement of quotes with your insurance company";
        $message['order_no'] = $order_no;
        $message['order_id'] = $order->id;
        $message['body1'] = "You have successfully completed the placement of quote with your insurance company for ";
        $message['body2'] = ". Stay tuned and receive updates on the quotes status.";
        $message['link1'] = url('user/order/summary', $order->id);
        $message['type'] = "order";
        $message['email'] = auth()->user()->email;

        $Notification = new Notification($message);
        dispatch($Notification);

        // web  or mail notification to the vendor
        $vendorbid = VendorBid::with('vendordetail')->find($vendor_bid_id);
        $vendor = Vendor::find($vendorbid->vendordetail->vendor_id);

        $message['title'] = "Order Placement";
        $message['order_no'] = $order_no;
        $message['order_id'] = $order->id;
        $message['body1'] = Auth::user()->name . " placed ";
        $message['body2'] = "successfully to you. The payment is pending because the customer request for payment to his insurance company. After paying by insurance company we will notify soon.";
        $message['link1'] = url('vendor/fullfillment', $order->id);
        $message['type'] = "order";
        $message['email'] = $vendor->email;

        $gettime = strtotime($vendor->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->vendor_id = $vendorbid->vendordetail->vendor_id;
            $notification->title = auth()->user()->name . " accepted your quote and placed an Order #" . $order_no . " payment will be paid by insurance company";
            $notification->links = url('vendor/fullfillment', $order->id);
            $notification->body = ' ';
            $notification->save();
        }

        //mail notification to Insurance Company
        $message['title'] = "Incomplete order reminder";
        $message['order_no'] = $order_no;
        $message['order_id'] = $order->id;
        $message['body1'] = "Our most qualified garages and service providers are excited to work on ";
        $message['body2'] = " we kindly request you to take a moment to select the service providers to streamline the process of completion for your customer.";
        $message['link1'] = url('user/car/detail', $vendor_bid_id);
        $message['type'] = "order";
        $message['email'] = $company->company[0]->email;

        $company = User::find($company_id);
        $gettime = strtotime($company->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->customer_id = $company_id;
            $notification->title = auth()->user()->name . " requested for car insurance , Order no #" . $order_no;
            $notification->links = url('user/car/detail', $vendor_bid_id);
            $notification->body = ' ';
            $notification->save();
        }

        $_SESSION["msg"] = "Your order is placed and payment request sended to Insurance Company Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.order.index');
    }
}
