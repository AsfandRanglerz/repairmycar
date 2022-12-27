<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Company;
use App\Models\ContactVendor;
use App\Models\Garage;
use App\Models\GarageCategory;
use App\Models\ModelYear;
use App\Models\News;
use App\Models\PrivacyPolicy;
use App\Models\Slider;
use App\Models\TermCondition;
use App\Models\User;
use App\Models\UserBid;
use App\Models\UserBidCategory;
use App\Models\UserBidImage;
use App\Models\UserReview;
use App\Models\UserWishlist;
use App\Models\VendorQuote;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $data['page_title'] = "home";
        $data['services'] = Category::limit(8)->orderby('position', 'ASC')->get();
        $data['news'] = News::limit(4)->latest()->get();
        $data['ads'] = Ads::limit(8)->latest()->get();
        $data['garage'] = Garage::limit(8)->latest()->get();
        $data['slider'] = Slider::all();
        $data['all_services'] = Category::latest()->get();

        return view('web/index', $data);
    }
    public function categoryGarage(Request $request)
    {
        $data = GarageCategory::where('category_id', $request->val)->with('garage')->get();

        return view('web/appendGarage', compact('data'));

    }
    public function carService()
    {
        $data['page_title'] = "carservice Page";
        $data['services'] = Category::orderby('position', 'ASC')->get();

        return view('web.car_service', $data);
    }

    public function vendorsByService($id)
    {
        $data['page_title'] = 'vendors by service';
        $data['id'] = $id;
        $garage_category = GarageCategory::where('category_id', $id)->distinct()->pluck('garage_id');
        $data['garages'] = Garage::whereIn('id', $garage_category)->get();

        return view('web.vendorlistbyservice', $data);
    }
    public function serviceGarage(Request $request)
    {
        $search = $request->val;
        $data['garages'] = GarageCategory::where('category_id', $request->service)->with('garage')->whereHas('garage', function ($query) use ($search) {
            $query->where('garage_name', 'LIKE', "%$search%");
        })->get();

        return view('web.append_servicesGarage', $data);
    }
    public function allvendor()
    {
        $data['page_title'] = 'vendors list';
        $data['garages'] = Garage::all();
        return view('web.vendorlist', $data);
    }

    public function vendorDetails($id)
    {
        $data['company'] = Company::all();
        $data['year'] = ModelYear::all();
        $data['catagary'] = Category::all();
        // $data['page_title'] = 'Request Quote';
        $data['page_title'] = 'vendor detail';
        $data['garage'] = Garage::find($id);
        $data['services'] = Category::all();
        $data['user_wishlist'] = \App\Models\UserWishlist::where('user_id', auth()->id())->where('garage_id', $data['garage']->id)->first();
        $data['user_review'] = \App\Models\UserReview::where('garage_id', $data['garage']->id)->get();
        $totalReviews = UserReview::where('garage_id', $data['garage']->id)->count();
        $rating = UserReview::where('garage_id', $data['garage']->id)->sum('rating');
        if ($totalReviews == 0 && $rating == 0) {
            $data['overAllRatings'] = 0;
        } else {
            $data['overAllRatings'] = $rating / $totalReviews;
        }
        // return $data;
        return view('web.gerage_detail', $data);
    }

    public function contactVendor(Request $request)
    {

         return $request;
        if (User::where('email', $request->email)->doesntExist()) {
            return redirect()->route('loginpage')->with(['message' =>'Your given email is not Registered! Please inter valid email or Register first', 'alert' => 'error']);
        } else {
            $user = User::where('email', $request->email)->first();
            $vendor = Garage::find($request->garage_id);

            $request->validate([
                'car_images' => 'required',
                'looking_for' => 'required',
                'model' => 'required',
                'company_id' => 'required',
                'model_year_id' => 'required',
                'mileage' => 'required',
                'day' => 'required',
                'maker_name' => 'required',
                'address' => 'required',
                'registration_no' => 'required',
                'Chasis_no' => 'required',
                'color' => 'required',
            ]);
            if ($request->looking_for == 'I have Inspection Report & Looking for the Quotations') {
                $request->validate([
                    'files' => 'required',
                ]);
            }
            if ($request->looking_for == 'I have Inspection Report & Looking for the Quotations' || $request->looking_for == "I know about what i'm looking for and requesting for the Quotations") {
                $request->validate([
                    'category' => 'required',
                ]);
            }

            $quote = new UserBid();
            $quote->user_id = $user->id;
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

            // this is car image save
            $imagefiles = new UserBidImage();
            if ($request->file('car_images')) {
                $images = [];
                foreach ($request->file('car_images') as $data) {
                    $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                    $data->move('public/image/ads/', $image);
                    $images[] = 'public/image/ads/' . $image;
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
                $request->file('files')->move('public/image/ads/', $doucments);
                $file = 'public/image/ads/' . $doucments;
                $registrationfiles->user_bid_id = $quote->id;
                $registrationfiles->car_image = $file;
                $registrationfiles->type = 'file';
                $registrationfiles->save();
            }
            // this is registration doucment
            $accidentailfile = new UserBidImage();
            if ($request->file('doucment')) {
                $files = [];
                foreach ($request->file('doucment') as $data) {
                    $doucments = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                    $data->move('public/image/ads/', $doucments);
                    $files[] = 'public/image/ads/' . $doucments;
                }
                $accidentailfile->user_bid_id = $quote->id;
                $accidentailfile->car_image = implode(",", $files);
                $accidentailfile->type = 'registerImage';
                $accidentailfile->save();
            }

            if ($request->category) {
                foreach ($request->category as $data) {
                    $category = new UserBidCategory();
                    $category->user_bid_id = $quote->id;
                    $category->category_id = $data;
                    $category->save();
                }
            }

            $vendor_quote = new VendorQuote;
            $vendor_quote->user_id = $user->id;
            $vendor_quote->user_bit_id = $quote->id;
            $vendor_quote->vendor_id = $vendor->vendor_id;
            $vendor_quote->save();
            return redirect()->back()->with(['message' =>'Your Qoute has been submitted successfully', 'alert' => 'success']);

            // $SendNotification = new SendNotification();
            // dispatch($SendNotification);

            // if ($request->action == 'all_garage') {

            //     return $this->message($quote, 'user.quoteindex', 'Quotation has been sent to all the Garages', 'Quotation has not been sent to all the Garages');
            // } else {
            //     return $this->message($quote, 'user.quoteindex', 'Quotation has been sent to all the Preffered Garages', 'Quotation has not been sent to all the Preffered Garages');
            // }

        }
        // $request->validate([
        //     'car_model' => 'required',
        //     'car_make' => 'required',
        //     'category' => 'required',
        //     'customer_name' => 'required',
        //     'email' => 'required',
        //     'contact_no' => 'required',
        //     'detail' => 'required',
        // ]);
        // $contact_vendors = new ContactVendor();
        // $contact_vendors->car_model = $request->car_model;
        // $contact_vendors->car_make = $request->car_make;
        // $contact_vendors->category = $request->category;
        // $contact_vendors->customer_name = $request->customer_name;
        // $contact_vendors->email = $request->email;
        // $contact_vendors->contact_no = $request->contact_no;
        // $contact_vendors->detail = $request->detail;
        // $contact_vendors->save();
        // return redirect()->back()->with('alert-success', 'Contacted Vendor successfully');
    }

    public function addToPrefferedGarage(Request $request)
    {
        // dd($request);
        $preferredgarageexist = \App\Models\UserWishlist::where('user_id', $request->user_id)->where('garage_id', $request->garage_id)->first();
        if ($preferredgarageexist) {
            $preferredgarageexist->delete();
            return redirect()->back()->with('alert-garage-success', 'Removed from Preffered Successfully');
        } else {
            $preferred_garage = new \App\Models\UserWishlist();
            $preferred_garage->user_id = $request->user_id;
            $preferred_garage->garage_id = $request->garage_id;
            $preferred_garage->save();
            return redirect()->back()->with('alert-garage-success', 'Added To Preffered Successfully');
        }
    }

    public function serviceDetail($id)
    {
        dd('dfd');
        $data['page_title'] = "Service Detail Page";
        $data['services'] = Category::find($id);
        return view('web.car_service', $data);
    }

    public function register()
    {
        $page_title = 'Register Page';
        return view('web.register', compact('page_title'));
    }
    public function usedcars()
    {
        $data['page_title'] = 'used cars';
        $data['ads'] = Ads::all();
        $data['company'] = Company::all();
        $data['year'] = ModelYear::all();
        return view('web.used_cars', $data);
    }
    public function searchCar(Request $request)
    {

        $search[] = $request->modelFrom;
        $search[] = $request->modelTo;
        $search1 = $request->company_id;
        $data['page_title'] = 'used cars';
        $data['ads'] = Ads::whereBetween('price', [$request->priceFrom, $request->priceTo])->where('city', $request->city)->with('modelYear', 'company')->whereHas('modelYear', function ($query) use ($search) {
            $query->whereBetween('model_year', [$search[0], $search[1]]);})->whereHas('company', function ($query) use ($search1) {$query->where('company', $search1);})->get();
        $data['company'] = Company::all();
        $data['year'] = ModelYear::all();
        return view('web.used_cars', $data);
    }
    public function carDetail($id)
    {
        $data['page_title'] = 'used car';
        $data['ad'] = Ads::find($id);

        return view('web.car_detail', $data);
    }

    public function searchService(Request $request)
    {
        $search = $request->query('keywords');
        $category = $request->query('category');
        $garage_category = GarageCategory::where('category_id', $category)->pluck('garage_id');

        if ($garage_category) {
            $data['garages'] = Garage::where(function ($q) use ($search) {
                $q->where('garage_name', 'Like', '%' . $search . '%');
            })->whereIn('id', $garage_category)->distinct()->get();
            return view('web.vendorlistbyservice', $data);
        } else {
            $data['garages'] = Garage::where(function ($q) use ($search) {
                $q->where('garage_name', 'Like', '%' . $search . '%');
            })->get();

            return view('web.vendorlistbyservice', $data);
        }
    }
    public function searchGarage()
    {

        $data['page_title'] = 'vendor detail';
        $data['garage'] = Garage::find($_GET['garage']);
        $data['services'] = Category::all();
        $data['user_wishlist'] = \App\Models\UserWishlist::where('user_id', auth()->id())->where('garage_id', $data['garage']->id)->first();
        $data['user_review'] = \App\Models\UserReview::where('garage_id', $data['garage']->id)->get();
        $totalReviews = UserReview::where('garage_id', $data['garage']->id)->count();
        $rating = UserReview::where('garage_id', $data['garage']->id)->sum('rating');
        if ($totalReviews == 0 && $rating == 0) {
            $data['overAllRatings'] = 0;
        } else {
            $data['overAllRatings'] = $rating / $totalReviews;
        }
        return view('web.gerage_detail', $data);
    }

    public function news()
    {
        $data['page_title'] = 'latest news';
        $data['news'] = News::all();
        return view('web.news', $data);
    }

    public function newsDetail($id)
    {
        $data['page_title'] = 'latest news';
        $data['news'] = News::find($id);
        return view('web.news_detail', $data);
    }

    public function faqnews()
    {
        $page_title = 'faq';
        return view('web.faq', compact('page_title'));
    }
    public function forget_pass()
    {
        $page_title = 'forget password';
        return view('web.forgetpassword', compact('page_title'));
    }
    public function term()
    {
        $page_title = 'Terms And Conditions';
        $term = TermCondition::firstorFail();
        return view('web.term', compact('page_title', 'term'));
    }
    public function privacyPolicy()
    {
        $page_title = 'Privacy Policy';
        $privacyPolicy = PrivacyPolicy::firstorFail();
        return view('web.privacyPolicy', compact('page_title', 'privacyPolicy'));
    }
    public function loginchoice()
    {
        $page_title = 'login choice';
        return view('web.loginpage', compact('page_title'));
    }
    public function about()
    {
        $page_title = 'about';
        $about = About::firstorFail();
        return view('web.about', compact('page_title', 'about'));
    }

}
