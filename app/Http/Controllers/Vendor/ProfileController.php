<?php

namespace App\Http\Controllers\vendor;

use App\Models\User;
use App\Models\vendor;
use Illuminate\Http\Request;
use App\Models\PaymentPercentage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Profile';
        $data = Vendor::findOrFail(Auth::id());
        return view('vendor.profile.index', compact('page_title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = User::where('type','company')->get();
        $profile = Vendor::with('company')->findOrFail($id);
        $vat = PaymentPercentage::select('percentage')->where('type','vat')->first();

        return view('vendor.profile.edit', compact('profile', 'company','vat'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'city' => 'required',
            'postbox' => 'required',
            'vat' => 'required',
            'billing_area' => 'required',
            'appointment_number' => 'required',
            'billing_address' => 'required',
        ]);

        $vendor = Vendor::findOrFail($id);
        if ($request->file('profile_images')) {
            $images = [];
            foreach ($request->file('profile_images') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/profile/', $image);
                $images[] = 'public/image/profile/' . $image;
            }
            $vendor->image = implode(",", $images);
        }
        if ($request->file('id_card')) {
            $images = [];
            foreach ($request->file('id_card') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/profile/', $image);
                $images[] = 'public/image/profile/' . $image;
            }
            $vendor->id_card = implode(",", $images);
        }
        if ($request->file('image_license')) {
            $images = [];
            foreach ($request->file('image_license') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/profile/', $image);
                $images[] = 'public/image/profile/' . $image;
            }
            $vendor->image_license = implode(",", $images);
        }
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->country = $request->country;
        $vendor->post_box = $request->postbox;
        $vendor->phone = $request->appointment_number;
        $vendor->landline_no = $request->landline_no;
        $vendor->city = $request->city;
        $vat = explode(' ', $request->vat);
        $vendor->vat = (int) filter_var($vat[0], FILTER_SANITIZE_NUMBER_INT);
        $vendor->billing_area = $request->billing_area;
        $vendor->billing_city = $request->billing_city;
        $vendor->billing_address = $request->billing_address;
        $vendor->address = $request->billing_address;
        $vendor->trading_license = $request->trading_license;
        $vendor->appointment_number = $request->appointment_number;
        $vendor->update();

        if (isset($request->company)) {

            $company = DB::table('insurance_vendor')->where('vendor_id', Auth::guard('vendor')->id())->delete();

            foreach($request->company as $id) {
                $company = User::find($id);
                $vendor->company()->attach($company);
            }
        }else{
            $company = DB::table('insurance_vendor')->where('vendor_id', Auth::guard('vendor')->id())->delete();
        }
        $_SESSION["msg"] ="Profile Updated Successfully";
        $_SESSION["alert"] ="success";
        return redirect()->route('vendor.profile.index',compact('vendor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
