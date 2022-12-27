<?php

namespace App\Http\Controllers\user;

use App\Models\Garage;
use App\Models\Company;
use App\Models\UserBid;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\ModelYear;
use App\Models\VendorBid;
use App\Models\VendorQuote;
use App\Models\UserBidImage;
use App\Models\UserWishlist;
use Illuminate\Http\Request;
use App\Jobs\SendNotification;
use App\Models\UserBidCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'quote/index ';
        $data['user_bid'] = UserBid::where([['user_id', Auth::id()], ['offer_status', '!=', 'ordered']])->orderBy('id', 'desc')->paginate(5);
        return view('user.quote.index', $data);
    }

    public function create()
    {
        $company = Company::all();
        $model = CarModel::all();
        $year = ModelYear::all();
        $catagary = Category::all();
        $page_title = 'Request Quote';
        return view('user.quote.create', compact('page_title', 'catagary', 'company', 'year','model'));
    }

    public function company(Request $request)
    {
        $model = CarModel::whereCompany_id($request->id)->get();
        $data = view('user.quote.append_model')->with(['model' => $model])->render();
        return response()->json([
            'success' => 'successfully',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // return $request;
        if ($request->action == "preferred_garage") {
            $data = UserWishlist::where('user_id', Auth::id())->with('garage')->get();
            if ($data->isEmpty()) {
                $_SESSION["msg"] = "Sorry you can't Quote because you've not any prefferred garage";
                $_SESSION["alert"] = "error";
                return redirect()->back();
            }
        }
        if ($request->looking_for == "I don't know the Problem and Requesting for the Inspection") {
            $request->validate([
                'car_images' => 'required',
                'document' => 'required',
                'looking_for' => 'required',
                'model' => 'required',
                'company_id' => 'required',
                'model_year_id' => 'required',
                'mileage' => 'required',
                'maker_name' => 'required',
                'address' => 'required',
                'registration_no' => 'required',
                'Chasis_no' => 'required',
                'color' => 'required',
            ]);
        } elseif ($request->looking_for == 'I have Inspection Report & Looking for the Quotations') {
            $request->validate([
                'files' => 'required',
                'category' => 'required',
                'car_images' => 'required',
                'looking_for' => 'required',
                'model' => 'required',
                'company_id' => 'required',
                'model_year_id' => 'required',
                'mileage' => 'required',
                'maker_name' => 'required',
                'address' => 'required',
                'registration_no' => 'required',
                'Chasis_no' => 'required',
                'color' => 'required',
                'document' => 'required',

            ]);
        } elseif ($request->looking_for == "I know about what i'm looking for and requesting for the Quotations") {
            $request->validate([
                'category' => 'required',
                'car_images' => 'required',
                'looking_for' => 'required',
                'model' => 'required',
                'company_id' => 'required',
                'model_year_id' => 'required',
                'mileage' => 'required',
                'maker_name' => 'required',
                'address' => 'required',
                'registration_no' => 'required',
                'Chasis_no' => 'required',
                'color' => 'required',
                'document' => 'required',

            ]);
        } else {
            $request->validate([
                'looking_for' => 'required',
            ]);

        }
        $quote = new UserBid();
        $quote->user_id = Auth::id();
        $quote->model = $request->model;
        $quote->company_id = $request->company_id;
        $quote->model_year_id = $request->model_year_id;
        $quote->day = $request->day;
        $quote->mileage = $request->mileage;
        $quote->reference_no = mt_rand(123456, 9999999);
        $quote->description1 = $request->description1;
        $quote->description2 = $request->description2;
        $quote->car_owner_name = $request->maker_name;
        $quote->phone = $request->phone;
        $quote->address = $request->address;
        $quote->registration_no = $request->registration_no;
        $quote->Chasis_no = $request->Chasis_no;
        $quote->color = $request->color;
        $quote->offer_status = "pending";
        $quote->looking_for = $request->looking_for;
        $quote->save();

        //mail notification to the vendor
        $message['body1'] = auth()->user()->name;
        $message['link1'] = url('vendor/quotedetail', $quote->id);
        $message['type'] = $request->action;
        $message['qoute_range'] = $request->qoute_range;
        $message['auth'] = Auth::id();

        // this is car image save
        $imagefiles = new UserBidImage();
        if ($request->file('car_images')) {
            $images = [];
            foreach ($request->file('car_images') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/add/', $image);
                $images[] = 'public/image/add/' . $image;
            }
            $imagefiles->user_bid_id = $quote->id;
            $imagefiles->car_image = implode(",", $images);

            $imagefiles->type = 'image';
            $imagefiles->save();
        }
        // police / accident report
        $registrationfiles = new UserBidImage();
        if ($request->file('files')) {
            $doucments = hexdec(uniqid()) . '.' . strtolower($request->file('files')->getClientOriginalExtension());
            $request->file('files')->move('public/image/add/', $doucments);
            $file = 'public/image/add/' . $doucments;
            $registrationfiles->user_bid_id = $quote->id;
            $registrationfiles->car_image = $file;
            $registrationfiles->type = 'file';
            $registrationfiles->save();
        }
        // this is registration document
        $accidentailfile = new UserBidImage();
        if ($request->file('document')) {
            $files = [];
            foreach ($request->file('document') as $data) {
                $doucments = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/add/', $doucments);
                $files[] = 'public/image/add/' . $doucments;
            }
            $accidentailfile->user_bid_id = $quote->id;
            $accidentailfile->car_image = implode(",", $files);
            $accidentailfile->type = 'registerImage';
            $accidentailfile->save();
        }
        if ($request->category) {
            foreach ($request->category as $data) {
                $user = new UserBidCategory();
                $user->user_bid_id = $quote->id;
                $user->category_id = $data;
                $user->save();
            }
        }

        if ($request->action == 'all_garage') {

            if ($request->qoute_range == 5) {
                $garage = Garage::orderBy('rating', 'desc')->limit(5)->get();
                foreach ($garage as $data) {
                    $object = new VendorQuote;
                    $object->user_id = Auth()->user()->id;
                    $object->user_bit_id = $quote->id;
                    $object->vendor_id = $data->vendor_id;
                    $object->save();
                }
            } elseif ($request->qoute_range == 10) {
                $garage = Garage::orderBy('rating', 'desc')->limit(10)->get();
                foreach ($garage as $data) {
                    $object = new VendorQuote;
                    $object->user_id = Auth()->user()->id;
                    $object->user_bit_id = $quote->id;
                    $object->vendor_id = $data->vendor_id;
                    $object->save();
                }
            } else {
                $vendor_quote = new VendorQuote;
                $vendor_quote->user_id = Auth()->user()->id;
                $vendor_quote->user_bit_id = $quote->id;
                $vendor_quote->save();
            }

            $SendNotification = new SendNotification($message);
            dispatch($SendNotification);

        } else {
            $id = Auth()->user()->id;
            $garageIds = [];
            $data = UserWishlist::where('user_id', $id)->with('garage')->get();
            foreach ($data as $list_item) {
                array_push($garageIds, $list_item->garage->id);
            }

            if ($request->qoute_range == 5) {
                $garage = Garage::whereIn('id', $garageIds)->orderBy('rating', 'desc')->limit(5)->get();
            } elseif ($request->qoute_range == 10) {

                $garage = Garage::whereIn('id', $garageIds)->orderBy('rating', 'desc')->limit(10)->get();
            } else {
                $garage = Garage::whereIn('id', $garageIds)->get();
            }
            foreach ($garage as $data) {
                $object = new VendorQuote;
                $object->user_id = Auth()->user()->id;
                $object->user_bit_id = $quote->id;
                $object->vendor_id = $data->vendor_id;
                $object->save();
            }
            
            $SendNotification = new SendNotification($message);
            dispatch($SendNotification);

        }

            $_SESSION["msg"] = "Your Request has been submitted successfully";
            $_SESSION["alert"] = "success";
            return redirect()->route('user.quoteindex');

    }

    public function reply($id)
    {
        $data = VendorBid::with('vendordetail')->where('user_bid_id', '=', $id)->paginate(1);
        $page_title = 'Qoute Response';
        return view('user.quote.response', compact('page_title', 'data'));
    }
    public function vendorResponse($id)
    {
        $data = VendorBid::with('vendordetail')->where('id', '=', $id)->first();
        $page_title = 'vendor response ';
        return view('user.quote.vendor_reply', compact('page_title', 'data'));
    }
    public function printOrderDetails($id)
    {
        $page_title = "Invoice";
        $value = 0;
        $data = VendorBid::with(['vendordetail', 'part' => function ($q) use ($value) {
            $q->where('status', '=', '1');
        }])->where('id', '=', $id)->first();
        // $data = VendorBid::where('id', $id)->with('part', 'vendordetail')->first();
        return view('user.quote.print_order_details', compact('data', 'page_title'));
    }

}
