<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Jobs\Notification;
use App\Models\Garage;
use App\Models\Part;
use App\Models\User;
use App\Models\UserBid;
use App\Models\VendorBid;
use App\Models\VendorBidStatus;
use App\Models\VendorQuote;
use App\Models\webNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'index ';
        $data['user_all_bid'] = VendorQuote::where('vendor_id', '=', null)->with('userbid')->whereHas('userbid', function ($q) {
            $q->Where('looking_for', '!=', "I don't know the Problem and Requesting for the Inspection")->Where('offer_status', '!=', 'ordered');
        })->orwhere('vendor_id', '=', auth()->user()->id)->with('userbid')->whereHas('userbid', function ($q) {
            $q->Where('looking_for', '!=', "I don't know the Problem and Requesting for the Inspection")->Where('offer_status', '!=', 'ordered');
        })->orderBy('id', 'DESC')->paginate(5);
        return view('vendor.quotes.index', $data);
    }

    public function search(Request $request)
    {
        if (isset($request->value)) {
            if ($request->value == 'all') {
                $_SESSION["search"] = ['user', 'company'];
                $search = ['user', 'company'];
            } else {
                $_SESSION["search"] = $request->value;
                $search[] = $request->value;
            }
        } else {
            if (gettype($_SESSION["search"]) == 'string') {
                $search[] = $_SESSION["search"];
            } else {
                $search = $_SESSION["search"];
            }
        }

        $page_title = 'index';
        $user_all_bid = VendorQuote::where('vendor_id', '=', null)->with('userbid', 'user')->whereHas('userbid', function ($q) {
            $q->Where('looking_for', '!=', "I don't know the Problem and Requesting for the Inspection")->Where('offer_status', '!=', 'ordered');
        })->whereHas('user', function ($q) use ($search) {
            $q->whereIn('type', $search);
        })->orwhere('vendor_id', '=', auth()->user()->id)->with('userbid')->whereHas('userbid', function ($q) {
            $q->Where('looking_for', '!=', "I don't know the Problem and Requesting for the Inspection")->Where('offer_status', '!=', 'ordered');
        })->whereHas('user', function ($q) use ($search) {
            $q->whereIn('type', $search);
        })->orderBy('id', 'DESC')->paginate(5);

        if (isset($request->page)) {
            return view('vendor.quotes.index', compact('user_all_bid', 'page_title'));
        }
        $data = view('vendor.quotes.search')->with(['user_all_bid' => $user_all_bid, 'page_title' => $page_title])->render();
        return response()->json([
            'success' => 'Status updated successfully',
            'data' => $data,
        ]);
    }
    public function requestedInspections()
    {

        $data['page_title'] = 'Requested Inspections';
        $data['user_all_bid'] = VendorQuote::where('vendor_id', '=', null)->with('userbid')->whereHas('userbid', function ($q) {
            $q->Where('looking_for', '=', "I don't know the Problem and Requesting for the Inspection")->Where('offer_status', '!=', 'ordered');
        })->orwhere('vendor_id', '=', auth()->user()->id)->with('userbid')->whereHas('userbid', function ($q) {
            $q->Where('looking_for', '=', "I don't know the Problem and Requesting for the Inspection")->Where('offer_status', '!=', 'ordered');
        })->orderBy('id', 'DESC')->paginate(5);

        return view('vendor.quotes.index', $data);
    }
    public function quotedetail($id)
    {

        $page_title = 'quote detail ';
        $data = UserBid::with('user', 'company', 'modelYear')->findOrFail($id);

        return view('vendor.quotes.detail', compact('page_title', 'data'));
    }
    public function bidresponse(Request $request)
    {
        if ($request->btnType == 1) {
            $page_title = 'Preview';
            $data = $request->all();
            $garage = Garage::where('vendor_id', auth()->id())->first();
            return view('vendor.quotes.preview', compact('page_title', 'data', 'garage'));
        }
        if (VendorBid::where('garage_id', auth()->user()->garage->id)->where('user_bid_id', $request->bid_id)->doesntExist()) {
            $request->validate([
                'bid_id' => 'required',
                'garage_id' => 'required',
                'price' => 'required',
                'time' => 'required',
                'description' => 'required',
                'service_name' => 'required',
                'service_quantity' => 'required',
                'services_rate' => 'required',
                'spares_name' => 'required',
                'spares_quantity' => 'required',
                'spares_rate' => 'required',
                'others_name' => 'required',
                'others_quantity' => 'required',
                'others_rate' => 'required',
                'vat' => 'required',
                'net_total' => 'required',
            ]);

            $data = new \App\Models\VendorBid();
            $data->user_bid_id = $request->bid_id;
            $data->garage_id = $request->garage_id;
            $data->price = $request->price;
            $data->time = $request->time;
            $data->description = $request->description;
            $data->vat = $request->vat;
            $data->net_total = $request->net_total;
            $data->save();

            if (count($request->service_name) > 0) {

                for ($i = 0; $i < count($request->service_name); $i++) {
                    if ($request->service_quantity[$i] != 0) {
                        $services = [
                            'vendor_bid_id' => $data->id,
                            'service_name' => $request->service_name[$i],
                            'service_quantity' => $request->service_quantity[$i],
                            'service_rate' => $request->services_rate[$i],
                            'type' => 'services',
                        ];
                        Part::create($services);
                    }
                }
            }
            if (count($request->spares_name) > 0) {

                for ($i = 0; $i < count($request->spares_name); $i++) {
                    if ($request->service_quantity[$i] != 0) {
                        $spares = [
                            'vendor_bid_id' => $data->id,
                            'service_name' => $request->spares_name[$i],
                            'service_quantity' => $request->spares_quantity[$i],
                            'service_rate' => $request->spares_rate[$i],
                            'type' => 'spares',
                        ];
                        Part::create($spares);
                    }
                }
            }
            if (count($request->others_name) > 0) {
                for ($i = 0; $i < count($request->others_name); $i++) {
                    if ($request->others_quantity[$i] != 0) {
                        $other = [
                            'vendor_bid_id' => $data->id,
                            'service_name' => $request->others_name[$i],
                            'service_quantity' => $request->others_quantity[$i],
                            'service_rate' => $request->others_rate[$i],
                            'type' => 'others',
                        ];
                        Part::create($other);
                    }
                }
            }

            // check  after sending bid on user quote
            $status = new VendorBidStatus();
            $status->vendor_id = $request->vendor_id;
            $status->user_bid_id = $request->bid_id;
            $status->status = 1;
            $status->save();

            //notification to the customer of placing the bid on his quote
            $qoute = UserBid::find($request->bid_id);
            $garage = Garage::where('vendor_id', auth()->id())->first();
            $user = User::find($qoute->user_id);

            $message['body1'] = $garage->garage_name;
            $message['link1'] = route('user.vendorReply', $data->id);
            $message['type'] = "quote";
            $message['email'] = $user->email;

            $gettime = strtotime($user->online_status) + 10;
            $now = strtotime(Carbon::now());
            if ($now > $gettime) {
                $Notification = new Notification($message);
                dispatch($Notification);
            } else {
                $notification = new webNotification();
                $notification->customer_id = $qoute->user_id;
                $notification->title = auth()->user()->name . " " . "placed a bid on your Quote";
                $notification->links = route('user.vendorReply', $data->id);
                $notification->body = '.';
                $notification->save();
            }

            // session_start();
            $_SESSION["msg"] = "Successfully responded on bid";
            $_SESSION["alert"] = "success";
            return redirect()->route('vendor.quoteindex');
            // return $this->message($data, 'vendor.quoteindex', 'Successfully responded on bid ', '  Error');
        } else {
            // session_start();
            $_SESSION["msg"] = "You are already bided on this quote";
            $_SESSION["alert"] = "error";
            return redirect()->back();
            // return redirect()->back()->with(['message' => 'You are already bided on this quote', 'alert' => 'error']);

        }
    }

    //vendor view offer
    public function viewOffer($id)
    {

        $data = VendorBid::with('part', 'vendordetail')->where('user_bid_id', $id)->first();
        return view('vendor.quotes.quote_offer_details', compact('data'));
    }
}
