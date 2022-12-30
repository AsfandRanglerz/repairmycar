<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\Notification;
use App\Models\InsuranceRequest;
use App\Models\Order;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorBid;
use App\Models\webNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use TelrGateway\TelrManager;

class RequestController extends Controller
{
    public function index()
    {

        $page_title = 'index ';
        $insurance = InsuranceRequest::with('customer', 'bid')->where('company_id', Auth::id())->orderBy('id', 'desc')->paginate(5);
        return view('user.insuranceRequest.index', compact('insurance', 'page_title'));
    }

    public function carDetail($id)
    {
        // return $id;
        $data = VendorBid::with('vendordetail')->where('id', '=', $id)->first();
        $page_title = 'detail';
        return view('user.insuranceRequest.request_detail', compact('page_title', 'data'));
    }

    public function printOrderDetails($id)
    {
        $value = 0;
        $data = VendorBid::with(['vendordetail', 'part' => function ($q) use ($value) {
            $q->where('status', '=', '1');
        }])->where('id', '=', $id)->first();
        return view('user.insuranceRequest.print_order_details', compact('data'));
    }

    public function Payment($id)
    {
        $data = VendorBid::where('id', '=', $id)->first();
        return view('user.insuranceRequest.payment', compact('data'));

    }

    /** Insucrance conmpany pay the payment through the check */
    public function throughCheck(Request $request)
    {
        $request->validate([
            'cheque_image' => 'required',
        ]);

        $order = Order::where('vendor_bid_id', $request->vendor_bid_id)->first();
        if ($request->file('cheque_image')) {
            $name = time() . '.' . $request->file('cheque_image')->getClientOriginalExtension();
            $name = $request->file('cheque_image')->move('public/image/profile/', $name);
            $order['cheque_image'] = $name;
        }
        $order->save();

        $insurance = InsuranceRequest::where('vendor_bid_id', $request->vendor_bid_id)->first();
        $insurance->status = 1;
        $insurance->save();

        $vendorbid = VendorBid::with('vendordetail', 'userBid', 'order')->where('id', '=', $request->vendor_bid_id)->first();

        $user = User::find($vendorbid->userBid->user_id);

        // notification content
        $message['title'] = "Payment Completed";
        $message['order_no'] = $vendorbid->order->order_code;
        $message['order_id'] = $vendorbid->order->id;
        $message['body1'] = "Congratulations, your insurance company " . Auth::guard('web')->user()->name . " has completed the payment for your ";
        $message['body2'] = " . Enjoy your service, please don’t forget to download the invoice for your record, and rate the service that you have received from your garage/service provider. ";
        $message['link1'] = url('user/order/summary', $vendorbid->order->id);
        $message['type'] = "order";
        $message['email'] = $user->email;

        //mail or web notification to user
        $gettime = strtotime($user->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->customer_id = $user->id;
            $notification->title = "The Insurance Company " . Auth::guard('web')->user()->name . " paid the payment against Order #" . $vendorbid->order->order_code;
            $notification->links = url('user/order/summary', $vendorbid->order->id);
            $notification->body = ' ';
            $notification->save();
        }

        // web  or mail notification to the vendor
        $vendor = Vendor::find($vendorbid->vendordetail->vendor_id);

        $message['title'] = "Payment Confirmation";
        $message['order_no'] = $vendorbid->order->order_code;
        $message['order_id'] = $vendorbid->order->id;
        $message['body1'] = "The Insurance Company " . Auth::guard('web')->user()->name . " has been release the payment against";
        $message['body2'] = ".";
        $message['link1'] = url('vendor/fullfillment', $vendorbid->order->id);
        $message['type'] = "order";
        $message['email'] = $vendor->email;

        $gettime = strtotime($vendor->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->vendor_id = $vendor->id;
            $notification->title = "The " . Auth::guard('web')->user()->name . " has been release the payment against Order #" . $vendorbid->order->order_code;
            $notification->links = url('vendor/fullfillment', $vendorbid->order->id);
            $notification->body = ' ';
            $notification->save();
        }
        $_SESSION["msg"] = "Payment Successfully paid and Request is Approved";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.insurance-index');
    }

    /** Insurance Conpany pay payment through the credit card */
    public function throughCard(Request $request)
    {
        /**Temprary data store */
        $data = TransactionDetail::find(1);
        $data->body = $request->vendor_bid_id;
        $data->save();

        /** edit config for current runtime*/
        config(['telr.create.return_auth' => '/user/insurance-payment/success']);
        config(['telr.create.return_can' => '/user/insurance-payment/cancel']);
        config(['telr.create.return_decl' => '/user/insurance-payment/declined']);
        $fp = fopen(base_path() . '/config/telr.php', 'w');
        fwrite($fp, '<?php return ' . var_export(config('telr'), true) . ';');
        fclose($fp);
        Artisan::call('cache:clear');

        $amount = explode(" ", $request->amount);
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
        return $telrManager->pay($order_id, $total, 'payment by insurance company on customer request', $billingParams)->redirect();

    }

    public function paymentSuccess(Request $request)
    {
        $data = TransactionDetail::find(1);
        $vendor_bid_id = $data->body;

        $insurance = InsuranceRequest::where('vendor_bid_id', $vendor_bid_id)->first();
        $insurance->status = 1;
        $insurance->save();

        $vendorbid = VendorBid::with('vendordetail', 'userBid', 'order')->where('id', '=', $vendor_bid_id)->first();

        $user = User::find($vendorbid->userBid->user_id);

        // notification content
        $message['title'] = "Payment Completed";
        $message['order_no'] = $vendorbid->order->order_code;
        $message['order_id'] = $vendorbid->order->id;
        $message['body1'] = "Congratulations, your insurance company " . Auth::guard('web')->user()->name . " has completed the payment for your ";
        $message['body2'] = " . Enjoy your service, please don’t forget to download the invoice for your record, and rate the service that you have received from your garage/service provider. ";
        $message['link1'] = url('user/order/summary', $vendorbid->order->id);
        $message['type'] = "order";
        $message['email'] = $user->email;

        //mail or web notification to user
        $gettime = strtotime($user->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->customer_id = $user->id;
            $notification->title = "The Insurance Company " . Auth::guard('web')->user()->name . " paid the payment against Order #" . $vendorbid->order->order_code;
            $notification->links = url('user/order/summary', $vendorbid->order->id);
            $notification->body = ' ';
            $notification->save();
        }

        // web  or mail notification to the vendor
        $vendor = Vendor::find($vendorbid->vendordetail->vendor_id);

        $message['title'] = "Payment Confirmation";
        $message['order_no'] = $vendorbid->order->order_code;
        $message['order_id'] = $vendorbid->order->id;
        $message['body1'] = "The Insurance Company " . Auth::guard('web')->user()->name . " has been release the payment against";
        $message['body2'] = ".";
        $message['link1'] = url('vendor/fullfillment', $vendorbid->order->id);
        $message['type'] = "order";
        $message['email'] = $vendor->email;

        $gettime = strtotime($vendor->online_status) + 10;
        $now = strtotime(Carbon::now());
        if ($now > $gettime) {
            $Notification = new Notification($message);
            dispatch($Notification);
        } else {
            $notification = new webNotification();
            $notification->vendor_id = $vendor->id;
            $notification->title = "The " . Auth::guard('web')->user()->name . " has been release the payment against Order #" . $vendorbid->order->order_code;
            $notification->links = url('vendor/fullfillment', $vendorbid->order->id);
            $notification->body = ' ';
            $notification->save();
        }
        $_SESSION["msg"] = "Payment Successfully paid and Request is Approved";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.insurance-index');
    }

    public function paymentCancel(Request $request)
    {
        $data = TransactionDetail::find(1);
        $vendor_bid_id = $data->body;

        $_SESSION["msg"] = "Your request has been Cancelled";
        $_SESSION["alert"] = "success";
        $data = VendorBid::where('id', '=', $vendor_bid_id)->first();
        return view('user.insuranceRequest.payment', compact('data'));
    }

    public function paymentDeclined(Request $request)
    {
        $data = TransactionDetail::find(1);
        $vendor_bid_id = $data->body;

        $_SESSION["msg"] = "Your request has been Declined";
        $_SESSION["alert"] = "success";
        $data = VendorBid::where('id', '=', $vendor_bid_id)->first();
        return view('user.insuranceRequest.payment', compact('data'));
    }

}
