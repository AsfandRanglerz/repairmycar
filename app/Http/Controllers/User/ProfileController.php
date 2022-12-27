<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\userCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $page_title = 'User Profile';
        return view('user.profile.index', compact('user', 'page_title'));
    }

    public function edit($id)
    {
        $company = User::where('type', 'company')->get();

        $page_title = 'User Profile Edit';
        $profile = user::findOrFail($id);
        return view('user.profile.edit', compact('profile', 'page_title', 'company'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);
        $user = user::findOrFail($id);
        if ($request->file('images')) {
            $images = [];
            foreach ($request->file('images') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/profile/', $image);
                $images[] = 'public/image/profile/' . $image;
            }
            $user->image = implode(",", $images);
        }
        if (Auth::user()->type == "company") {
            $user->name = $request->company_name;
            $user->address = $request->billing_address;
            $user->post_box = $request->post_box;

        } else {
            $user->address = $request->address;
            $user->name = $request->name;
        }
        $user->phone = $request->phone;
        $user->landline_no = $request->landline_no;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->update();

        if (isset($request->company)) {
            $company = DB::table('insurance_user')->where('user_id', Auth::id())->delete();
            $company = User::find($request->company);
            $user->company()->attach($company);
        }

        if (Auth::user()->type == "company") {
            $company = userCompany::where('company_id', $user->id)->first();
            $company->owner_name = $request->name;
            $company->billing_area = $request->billing_area;
            $company->billing_city = $request->billing_city;
            $company->billing_address = $request->billing_address;
            $company->trading_license = $request->trading_license;

            if ($request->file('id_card')) {
                $images = [];
                foreach ($request->file('id_card') as $data) {
                    $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                    $data->move('public/image/profile/', $image);
                    $images[] = 'public/image/profile/' . $image;
                }
                $company->id_card = implode(",", $images);
            }
            if ($request->file('image_license')) {
                $images = [];
                foreach ($request->file('image_license') as $data) {
                    $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                    $data->move('public/image/profile/', $image);
                    $images[] = 'public/image/profile/' . $image;
                }
                $company->image_license = implode(",", $images);
            }
            $company->update();
        }
        $_SESSION["msg"] = "Profile Updated Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.profile.index');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::findOrFail($id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password),
            ])->save();

            $_SESSION["msg"] = "Update Password Successfully";
            $_SESSION["alert"] = "success";
            return redirect()->route('profile');
        } else {
            return redirect()->back()->with($this->data("Update Password Error", 'error'));
        }
    }

}
