<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\SendPrefferedGarage;
use App\Models\About;
use App\Models\Ads;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Company;
use App\Models\ContactVendor;
use App\Models\CookiePolicy;
use App\Models\Faq;
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
use App\Models\Vendor;
use App\Models\VendorQuote;
use App\Models\webNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomepageController extends Controller
{
    public function index()
    {
        $data['page_title'] = "home";
        $data['services'] = Category::limit(8)->orderby('position', 'ASC')->get();
        $data['news'] = News::limit(4)->latest()->get();
        $data['ads'] = Ads::limit(4)->latest()->where('status', 'Approved')->get();
        $data['garage'] = Garage::orderBy('rating', 'desc')->limit(4)->get();
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
        $data['services'] = Category::orderby('position', 'ASC')->paginate(8);

        return view('web.car_service', $data);
    }

    public function vendorsByService($id)
    {
        $data['page_title'] = 'vendors by service';
        $data['service'] = $id;
        $garage_category = GarageCategory::where('category_id', $id)->distinct()->pluck('garage_id');
        $data['garages'] = Garage::whereIn('id', $garage_category)->paginate(8);

        return view('web.vendorlistbyservice', $data);
    }
    public function serviceGarage(Request $request)
    {
        if(isset($request->service)){
            $_SESSION["service"] = $request->service;
        }
        isset($request->service)? $service  = $request->service : $service  = $_SESSION["service"];
        $data['service'] = $service;

        $search = $request->val;
        $garages= GarageCategory::where('category_id', $service)->with('garage')->whereHas('garage', function ($query) use ($search) {
            $query->where('garage_name', 'LIKE', "%$search%");
        })->pluck('garage_id');
        
        $data['garages'] = Garage::whereIn('id', $garages)->paginate(8);
        

        if($request->ajax()){
            return view('web.append_servicesGarage', $data);
        }else{
            return view('web.vendorlistbyservice', $data);
        }
    }

    public function topGarage(Request $request)
    {
        // return response()->json($request);

        $data['catagary'] = Category::all();
        $search = $request->val;
        $data['garages'] = Garage::where('garage_name', 'LIKE', "%$search%")->orderBy('rating', 'desc')->paginate(8);

        if (isset($request->val)) {
            return view('web.append_TopGarage', $data);
        } else {
            return view('web.vendorlist', $data);
        }
    }

    public function allvendor()
    {
        $data['catagary'] = Category::all();
        $data['page_title'] = 'vendors list';
        $data['garages'] = Garage::orderBy('rating', 'desc')->limit(8)->paginate(8);

        return view('web.vendorlist', $data);
    }

    public function vendorDetails($id)
    {
        $data['company'] = Company::all();
        $data['model'] = CarModel::all();
        $data['year'] = ModelYear::all();
        $data['catagary'] = Category::all();
        // $data['page_title'] = 'Request Quote';
        $data['page_title'] = 'vendor detail';
        $data['garage'] = Garage::with('vendor')->find($id);
        $data['services'] = Category::all();
        $data['user_wishlist'] = UserWishlist::where('user_id', auth()->id())->where('garage_id', $data['garage']->id)->first();
        $data['user_review'] = UserReview::where('garage_id', $data['garage']->id)->get();
        $totalReviews = UserReview::where('garage_id', $data['garage']->id)->count();
        $rating = UserReview::where('garage_id', $data['garage']->id)->sum('rating');
        if ($totalReviews == 0 && $rating == 0) {
            $data['overAllRatings'] = 0;
        } else {
            $data['overAllRatings'] = $rating / $totalReviews;
        }
        return view('web.gerage_detail', $data);
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

    public function contactVendor(Request $request)
    {
        if (isset($request->looking_for)) {
            if ($request->looking_for == "I don't know the Problem and Requesting for the Inspection") {
                $request->validate([
                    'car_images' => 'required',
                    'looking_for' => 'required',
                    'model' => 'required',
                    'company_id' => 'required',
                    'registration_no' => 'required',
                    'Chasis_no' => 'required',
                    'color' => 'required',
                    'model_year_id' => 'required',
                    'mileage' => 'required',
                    'document' => 'required',
                    'car_images' => 'required',
                    'email' => 'required',
                    'maker_name' => 'required',
                    'address' => 'required',
                ]);
            }
            if ($request->looking_for == 'I have Inspection Report & Looking for the Quotations') {
                $request->validate([
                    'files' => 'required',
                    'category' => 'required',
                    'car_images' => 'required',
                    'looking_for' => 'required',
                    'model' => 'required',
                    'company_id' => 'required',
                    'registration_no' => 'required',
                    'Chasis_no' => 'required',
                    'color' => 'required',
                    'model_year_id' => 'required',
                    'mileage' => 'required',
                    'document' => 'required',
                    'car_images' => 'required',
                    'email' => 'required',
                    'maker_name' => 'required',
                    'address' => 'required',
                ]);
            }
            if ($request->looking_for == "I know about what i'm looking for and requesting for the Quotations") {
                $request->validate([
                    'category' => 'required',
                    'car_images' => 'required',
                    'looking_for' => 'required',
                    'model' => 'required',
                    'company_id' => 'required',
                    'registration_no' => 'required',
                    'Chasis_no' => 'required',
                    'color' => 'required',
                    'model_year_id' => 'required',
                    'mileage' => 'required',
                    'document' => 'required',
                    'car_images' => 'required',
                    'email' => 'required',
                    'maker_name' => 'required',
                    'address' => 'required',
                ]);
            }
        } else {
            $request->validate([
                'category' => 'required',
                'looking_for' => 'required',
                'model' => 'required',
                'company_id' => 'required',
                'registration_no' => 'required',
                'Chasis_no' => 'required',
                'color' => 'required',
                'model_year_id' => 'required',
                'mileage' => 'required',
                'document' => 'required',
                'car_images' => 'required',
                'email' => 'required',
                'maker_name' => 'required',
                'address' => 'required',
            ]);

        }
        if (User::where('email', $request->email)->doesntExist()) {
            $_SESSION["msg"] = "Your given email is not Registered! Please enter valid email or Register first";
            $_SESSION["alert"] = "error";
            return redirect()->back();
        } else {
            $user = User::where('email', $request->email)->first();
            $vendor = Garage::find($request->garage_id);
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

            $vendor = Vendor::find($vendor->vendor_id);

            $message['body1'] = auth()->user()->name;
            $message['link1'] = url('vendor/quotedetail', $quote->id);

            $gettime = strtotime($vendor->online_status) + 10;
            $now = strtotime(Carbon::now());
            if ($now > $gettime) {
                Mail::to($vendor->email)->send(new SendPrefferedGarage($message));

            } else {
                $notification = new webNotification();
                $notification->vendor_id = $vendor->id;
                $notification->title = auth()->user()->name . " request a quote to you, Hurry up and put your bid on Quote";
                $notification->links = url('vendor/quotedetail', $quote->id);
                $notification->body = ' ';
                $notification->save();
            }
            $_SESSION["msg"] = "Your Quote has been submitted successfully";
            $_SESSION["alert"] = "success";
            return redirect()->back();
        }

    }

    public function addToPrefferedGarage(Request $request)
    {
        // dd($request);
        $preferredgarageexist = UserWishlist::where('user_id', $request->user_id)->where('garage_id', $request->garage_id)->first();
        if ($preferredgarageexist) {
            $preferredgarageexist->delete();
            return redirect()->back()->with('alert-garage-success', 'Removed from Preffered Successfully');
        } else {
            $preferred_garage = new UserWishlist();
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
        $data['ads'] = Ads::orderBy('id', 'desc')->where('status', 'Approved')->paginate(8);
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
        // fech records according filteration

        if (isset($request->priceFrom) && isset($request->priceTo) && isset($request->modelFrom) && isset($request->modelTo) && isset($request->city)) {
            $data['ads'] = Ads::with('modelYear', 'company')->whereBetween('price', [$request->priceFrom, $request->priceTo])->whereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->where('city', $request->city)->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->priceFrom) && isset($request->priceTo) && isset($request->modelFrom) && isset($request->modelTo)) {
            $data['ads'] = Ads::with('modelYear', 'company')->whereBetween('price', [$request->priceFrom, $request->priceTo])->orwhereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->modelFrom) && isset($request->modelTo) && isset($request->city)) {
            $data['ads'] = Ads::with('modelYear', 'company')->WhereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->where('city', $request->city)->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->modelFrom) && isset($request->modelTo) && isset($request->company_id)) {
            $data['ads'] = Ads::with('modelYear', 'company')->WhereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->orWhereHas('company', function ($query) use ($search1) {$query->where('company', $search1);})->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->modelFrom) && isset($request->modelTo) && isset($request->company_id)) {
            $data['ads'] = Ads::with('modelYear', 'company')->WhereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->orWhereHas('company', function ($query) use ($search1) {$query->where('company', $search1);})->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->priceFrom) && isset($request->priceTo)) {
            $data['ads'] = Ads::with('modelYear', 'company')->whereBetween('price', [$request->priceFrom, $request->priceTo])->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->modelFrom) && isset($request->modelTo)) {
            $data['ads'] = Ads::with('modelYear', 'company')->whereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->company_id) && isset($request->city)) {
            $data['ads'] = Ads::with('modelYear', 'company')->whereHas('company', function ($query) use ($search1) {$query->where('company', $search1);})->where('city', $request->city)->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->company_id)) {
            $data['ads'] = Ads::with('modelYear', 'company')->whereHas('company', function ($query) use ($search1) {$query->where('company', $search1);})->where('status', 'Approved')->paginate(8);
        } elseif (isset($request->city)) {
            $data['ads'] = Ads::with('modelYear', 'company')->where('city', $request->city)->where('status', 'Approved')->paginate(8);
        } else {
            $data['ads'] = Ads::whereBetween('price', [$request->priceFrom, $request->priceTo])->where('city', $request->city)->with('modelYear', 'company')->whereHas('modelYear', function ($query) use ($search) {
                $query->whereBetween('model_year', [$search[0], $search[1]]);})->whereHas('company', function ($query) use ($search1) {$query->where('company', $search1);})->where('status', 'Approved')->paginate(8);
        }
        //end felter

        $data['company'] = Company::all();
        $data['year'] = ModelYear::all();
        return view('web.used_cars', $data);
    }
    public function carDetail($id)
    {
        $data['page_title'] = 'used car';
        $data['ad'] = Ads::where('status', 'Approved')->find($id);

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
            })->whereIn('id', $garage_category)->distinct()->paginate(8);
            return view('web.vendorlistbyservice', $data);
        } else {
            $data['garages'] = Garage::where(function ($q) use ($search) {
                $q->where('garage_name', 'Like', '%' . $search . '%');
            })->paginate(8);

            return view('web.vendorlistbyservice', $data);
        }
    }
    public function searchGarage()
    {
        $data['company'] = Company::all();
        $data['model'] = CarModel::all();
        $data['year'] = ModelYear::all();
        $data['catagary'] = Category::all();
        $data['page_title'] = 'vendor detail';
        $data['garage'] = Garage::find($_GET['garage']);
        $data['services'] = Category::all();
        $data['user_wishlist'] = UserWishlist::where('user_id', auth()->id())->where('garage_id', $data['garage']->id)->first();
        $data['user_review'] = UserReview::where('garage_id', $data['garage']->id)->get();
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
        $data['news'] = News::paginate(8);
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
        $data = Faq::all();
        return view('web.faq', compact('page_title', 'data'));
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

    public function registerchoice()
    {

        $page_title = 'register choice';
        return view('web.registerpage', compact('page_title'));
    }
    public function about()
    {
        $page_title = 'about';
        $about = About::firstorFail();
        return view('web.about', compact('page_title', 'about'));
    }

/*------------ Create New password using Email when Admin Register new User-------------------*/
    public function passwordCreate(Request $request)
    {
        $data['type'] = $request->type;
        $data['email'] = $request->email;
        return view('web.password_create', $data);
    }
    public function passwordstore(Request $request)
    {
        if ($request->type == 'user') {
            $customer = User::whereEmail($request->email);
            $customer->update([
                'password' => bcrypt($request->password),
            ]);
            $_SESSION["msg"] = "Your password has been created successfully";
            $_SESSION["alert"] = "success";
            return redirect()->route('user.login');
        } elseif ($request->type == 'company') {
            $company = User::whereEmail($request->email);
            $company->update([
                'password' => bcrypt($request->password),
            ]);
            $_SESSION["msg"] = "Your password has been created successfully";
            $_SESSION["alert"] = "success";
            return redirect()->route('user.companyLogin');
        } else {
            $company = Vendor::whereEmail($request->email);
            $company->update([
                'password' => bcrypt($request->password),
            ]);
            $_SESSION["msg"] = "Your password has been created successfully";
            $_SESSION["alert"] = "success";
            return redirect()->route('vendor.login');
        }
    }
/*------------ End Create New password using Email when Admin Register new User-------------------*/

    public function cookies()
    {
        $cookiePolicy = CookiePolicy::find(1);

        return view('web.cookies', compact('cookiePolicy'));
    }

}
