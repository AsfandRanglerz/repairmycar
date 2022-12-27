<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Country;
use App\Models\Garage;
use App\Models\GarageCategory;
use App\Models\GarageTiming;
use App\Models\ModelYear;
use App\Models\PaymentPercentage;
use App\Models\UserReview;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $authvendor = Vendor::find(Auth::id());
        $page_title = 'WorkShop';
        $categories = Category::get();
        $countries = Country::all();
        return view('vendor.workshop.create', compact('page_title', 'authvendor', 'categories', 'countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $authvendor = Vendor::find($id);
        $page_title = 'WorkShop';
        $categories = Category::get();
        $countries = Country::all();
        return view('vendor.workshop.create', compact('page_title', 'authvendor', 'categories', 'countries'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'garage_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'post_box' => 'required',
            'category' => 'required',
            'trading_no' => 'required',
            'vat' => 'required',
        ]);

        $garage = new Garage();
        $garage->vendor_id = $request->vendor_id;
        $garage->trading_no = $request->trading_no;
        $vat = explode(' ', $request->vat);
        $garage->vat = (int) filter_var($vat[0], FILTER_SANITIZE_NUMBER_INT);
        $garage->phone = $request->phone;
        $garage->garage_name = $request->garage_name;
        $garage->description = $request->description;
        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move('public/image/garage/', $name);
                $garage['image'] = 'public/image/garage/' . $name;
            }
        }
        $garage->country = $request->country;
        $garage->city = $request->city;
        $garage->address = $request->address;
        $garage->post_box = $request->post_box;
        $garage->save();
        if ($garage) {

            $categories = $request->category;
            foreach ($categories as $cat) {

                $data = [
                    'garage_id' => $garage->id,
                    'category_id' => intval($cat),
                ];
                GarageCategory::create($data);
            }

            $length = count($request->day);

            for ($i = 0; $i < $length; $i++) {
                if (isset($request->closed[$i])) {
                    $closed = 1;
                } else {
                    $closed = 0;
                }
                GarageTiming::create([
                    'garage_id' => $garage->id,
                    'day' => $request->day[$i],
                    'from' => $request->from[$i],
                    'to' => $request->to[$i],
                    'closed' => $closed,
                ]);
            }
        }
        $data['company'] = Company::all();
        $data['year'] = ModelYear::all();
        $data['catagary'] = Category::all();
        $data['preview_garage'] = Garage::find($garage->id);
        $data['user_review'] = UserReview::where('garage_id', $garage->id)->get();
        $totalReviews = UserReview::where('garage_id', $garage->id)->count();
        $rating = UserReview::where('garage_id', $garage->id)->sum('rating');
        if ($totalReviews == 0 && $rating == 0) {
            $data['overAllRatings'] = 0;
        } else {
            $data['overAllRatings'] = $rating / $totalReviews;
        }

        if(Auth::guard('vendor')->check()){
            $_SESSION["msg"] = "You've Login Successfully";
            $_SESSION["alert"] = "success";
            return redirect()->route('vendor.dashboard');

        }

        $_SESSION["msg"] = "You've Registered Successfully as a Vendor, soon your account will be Activated!. You will be notified by email once your account is Activated!";
        $_SESSION["alert"] = "success";
        return redirect()->route('vendor.login');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $page_title = 'Edit Workshop';
        $garage = Garage::where('vendor_id', Auth::id())->with('vendor', 'garageCategory')->first();
        $categories = Category::all();
        $vat = PaymentPercentage::select('percentage')->where('type', 'vat')->first();
        return view('vendor.workshop.edit', compact('page_title', 'garage', 'categories', 'vat'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'garage_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'post_box' => 'required',
            'category' => 'required',
            'trading_no' => 'required',
            'vat' => 'required',
        ]);
        $garage = Garage::findOrFail($id);
        $garage->vendor_id = Auth::id();
        $garage->trading_no = $request->trading_no;
        $vat = explode(' ', $request->vat);
        $garage->vat = (int) filter_var($vat[0], FILTER_SANITIZE_NUMBER_INT);
        $garage->phone = $request->phone;
        $garage->garage_name = $request->garage_name;
        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move('public/image/garage/', $name);
                $garage['image'] = 'public/image/garage/' . $name;
            }
        }
        $garage->description = $request->description;
        $garage->country = $request->country;
        $garage->city = $request->city;
        $garage->address = $request->address;
        $garage->post_box = $request->post_box;
        $garage->save();
        if ($garage) {

            $data = GarageCategory::where('garage_id', $id)->get();
            foreach ($data as $cat) {
                $cat->delete();
            }
            $categories = $request->category;
            foreach ($categories as $cat) {
                $data = [
                    'garage_id' => $garage->id,
                    'category_id' => intval($cat),
                ];
                GarageCategory::create($data);
            }

            $garage_timing = GarageTiming::where('garage_id', $garage->id)->get();
            $length = count($garage_timing);
            for ($i = 0; $i < $length; $i++) {
                if (isset($request->closed[$i])) {

                    $closed = 1;
                } else {
                    $closed = 0;
                }
                GarageTiming::find($garage_timing[$i]->id)->update([
                    'garage_id' => $garage->id,
                    'day' => $request->day[$i],
                    'from' => $request->from[$i],
                    'to' => $request->to[$i],
                    'closed' => $closed,
                ]);
            }
        }
        $data['company'] = Company::all();
        $data['year'] = ModelYear::all();
        $data['catagary'] = Category::all();
        $data['preview_garage'] = Garage::find($garage->id);
        $data['user_review'] = UserReview::where('garage_id', $garage->id)->get();
        $totalReviews = UserReview::where('garage_id', $garage->id)->count();
        $rating = UserReview::where('garage_id', $garage->id)->sum('rating');
        if ($totalReviews == 0 && $rating == 0) {
            $data['overAllRatings'] = 0;
        } else {
            $data['overAllRatings'] = $rating / $totalReviews;
        }
        return view('vendor.workshop.preview_workshop', $data);

        $_SESSION["msg"] = "Workshop Updated Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('vendor.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function finish()
    {
        $garage = Garage::where('vendor_id', auth()->id())->first();

        $_SESSION["msg"] = "Workshop Saved Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('vendor.dashboard');
    }
}
