<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountStatus;
use App\Mail\Registration;
use App\Models\Category;
use App\Models\Garage;
use App\Models\PaymentPercentage;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vendors = Vendor::with('roles')
            ->whereHas('roles', function ($q) {
                $q->Where('name', 'vendor');
            })->orderBy('id', 'desc')
            ->get();
        $page_title = 'Vendor';
        return view("admin.vendor.index", compact('vendors', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $vat = PaymentPercentage::where('type', 'vat')->first();
        $company = User::where('type', 'company')->get();
        return view('admin.vendor.create', compact('company', 'categories', 'vat'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "id_card" => 'required',
            'name' => ['required', 'string', 'max:255'],
            'garage_name' => 'required',
            'garages_catagary' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendors'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'post_box' => 'required',
            'image_license' => 'required',
            'trading_license' => 'required',
            'vat' => 'required',
            'billing_area' => 'required',
            'billing_city' => 'required',
            'billing_address' => 'required',
            'appointment_number' => 'required',
        ]);

        $vendor = new Vendor();
        if ($request->file('profile_image')) {
            $doucments1 = hexdec(uniqid()) . '.' . strtolower($request->file('profile_image')->getClientOriginalExtension());
            $request->file('profile_image')->move('public/image/profile/', $doucments1);
            $file1 = 'public/image/profile/' . $doucments1;
            $vendor->image = $file1;
        } else {
            $vendor->image = "public/assets/images/1744022049828589.jpg";
        }
        if ($request->file('id_card')) {
            $doucments2 = hexdec(uniqid()) . '.' . strtolower($request->file('id_card')->getClientOriginalExtension());
            $request->file('id_card')->move('public/image/profile/', $doucments2);
            $file2 = 'public/image/profile/' . $doucments2;
            $vendor->id_card = $file2;
        }
        if ($request->file('image_license')) {
            $doucments3 = hexdec(uniqid()) . '.' . strtolower($request->file('image_license')->getClientOriginalExtension());
            $request->file('image_license')->move('public/image/profile/', $doucments3);
            $file3 = 'public/image/profile/' . $doucments3;
            $vendor->image_license = $file3;

        }

        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->appointment_number;
        $vendor->country = $request->country;
        $vendor->city = $request->city;
        $vendor->post_box = $request->post_box;
        $vendor->appointment_number = $request->appointment_number;
        $vendor->garage_name = $request->garage_name;
        $vat = explode(' ', $request->vat);
        $vendor->vat = (int) filter_var($vat[0], FILTER_SANITIZE_NUMBER_INT);
        $vendor->billing_area = $request->billing_area;
        $vendor->billing_city = $request->billing_city;
        $vendor->billing_address = $request->billing_address;
        $vendor->address = $request->billing_address;
        $vendor->garages_catagory = implode(',', $request->garages_catagary);
        $vendor->trading_license = $request->trading_license;
        $vendor->type = 'vendor';
        $vendor->save();

        /* ------------------Assign Insurance Company---------------------*/
        if (isset($request->company)) {
            foreach ($request->company as $id) {
                $company = User::find($id);
                $vendor->company()->attach($company);
            }
        }

        /* ------------------Assign role---------------------*/
        $role = Role::where('name', 'vendor')->first();
        $vendor->assignRole($role);

        /* ---Send mail to the Customer for creating his new password-----*/
        $data['name'] = $vendor->name;
        $data['email'] = $vendor->email;
        $data['type'] = $vendor->type;
        $data['id'] = $vendor->id;

        if ($vendor) {
            Mail::to($vendor->email)->send(new Registration($data));

            return $this->message($vendor, 'admin.vendor.index', 'Vendor Registered Successfully', 'Vendor Update Error');
        } else {
            return redirect()->back()->with($this->data("Vendor Register Error", 'error'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $company = User::where('type', 'company')->get();
        $garage = Garage::all();
        $vendor = Vendor::with('company')->findOrFail($id);
        $page_title = 'Vendor';
        return view('admin.vendor.edit', compact('vendor', 'page_title', 'company', 'garage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'garage_name' => 'required',
            'post_box' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'trading_license' => 'required',
            'vat' => 'required',
            'billing_area' => 'required',
            'billing_city' => 'required',
            'billing_address' => 'required',
            'appointment_number' => 'required',
        ]);
        $vendor = Vendor::findOrFail($id);
        if ($request->file('image')) {
            $images = [];
            foreach ($request->file('image') as $data) {
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
        $vendor->post_box = $request->post_box;
        $vendor->address = $request->address;
        $vendor->phone = $request->phone;
        $vendor->city = $request->city;
        $vendor->vat = $request->vat;
        $vendor->billing_area = $request->billing_area;
        $vendor->billing_city = $request->billing_city;
        $vendor->billing_address = $request->billing_address;
        $vendor->trading_license = $request->trading_license;
        $vendor->appointment_number = $request->appointment_number;
        $vendor->update();

        if (isset($request->company)) {

            $company = DB::table('insurance_vendor')->where('vendor_id', $vendor->id)->delete();

            foreach ($request->company as $id) {
                $company = User::find($id);
                $vendor->company()->attach($company);
            }
        }
        return $this->message($vendor, 'admin.vendor.index', 'Vendor Update Successfully', 'Vendor Update Error');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $vendor = Vendor::findOrFail($id);
        if ($vendor->hasRole('vendor')) {
            if (Hash::check($request->old_password, $vendor->password)) {
                $vendor->password = bcrypt($request->password);
                $vendor->save();

                return redirect()->route('admin.vendor.index')->with($this->data("Update Vendor Password Successfully", 'success'));
            } else {
                return redirect()->back()->with($this->data("Update Vendor Password Error", 'error'));
            }
        } else {
            return redirect()->back()->with($this->data('You do not have the required authorization!', 'error'));
        }

    }

    public function activate($id)
    {
        $vendor = Vendor::findOrFail($id);
        if ($vendor->hasRole('vendor')) {
            if ($vendor->action == 0) {
                $vendor->fill([
                    'action' => 1,
                ])->save();
                $data['name'] = $vendor->name;
                $data['data'] = 'Congratulation! Your account has been activated. Now you can login your account as a Vendor';
                Mail::to($vendor->email)->send(new AccountStatus($data));
                return redirect()->route('admin.vendor.index')->with($this->data("Vendor Activated Successfully", 'success'));
            } else {
                return redirect()->back()->with($this->data("Vendor Activated Error", 'error'));
            }
        } else {
            return redirect()->back()->with($this->data('You do not have the required authorization!', 'error'));
        }
    }

    public function deactivate(Request $request)
    {
        $vendor = Vendor::find($request->user_id);
        if ($vendor->hasRole('vendor')) {
            if ($vendor->action == 1) {
                $vendor->fill([
                    'action' => 0,
                ])->save();

                $data['name'] = $vendor->name;
                $data['data'] = "Your Account has been Deactivated due to the below reason:";
                $data['reason'] = $request->comment_val;

                Mail::to($vendor->email)->send(new AccountStatus($data));
                $message = 'Rejection message send successfully!';
                return response()->json([

                    'success' => 'Vendor DeActivated Successfully',
                    'message' => $message,
                ]);
            } else {
                return response()->json([
                    'success' => 'DeActivate Error',
                ]);
            }
        }
        //         return redirect()->route('admin.vendor.index')->with($this->data("Vendor DeActivate Successfully", 'success'));
        //     } else {
        //         return redirect()->back()->with($this->data("Vendor DeActivate Error", 'error'));
        //     }
        // } else {
        //     return redirect()->back()->with($this->data('You do not have the required authorization!', 'error'));
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $vendor = Vendor::findOrFail($id);
        if ($vendor->hasRole('vendor')) {
            $vendor->delete();
            return $this->message($vendor, 'admin.vendor.index', 'Vendor Delete successfully', 'Vendor Delete Error');
        } else {
            return redirect()->back()->with($this->data('You do not have the required authorization!', 'error'));
        }
    }
}
