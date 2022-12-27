<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountStatus;
use App\Mail\Registration;
use App\Models\User;
use App\Models\userCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class InsuranceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = User::with('roles', 'insurance')->where('type', 'company')->orderBy('id', 'desc')->get();
        $page_title = 'Insurance Company';
        return view('admin.insuranceCompany.index', compact('company', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.insuranceCompany.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => 'required',
            'city' => 'required',
            'id_card' => 'required',
            'image_license' => 'required',
            'owner_name' => 'required',
            'trading_license' => 'required',
            'billing_area' => 'required',
            'billing_city' => 'required',
            'billing_address' => 'required',
        ]);
        $company = new User();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->post_box = $request->post_box;
        $company->city = $request->city;
        $company->type = 'company';

        if ($request->file('image')) {
            $doucments1 = hexdec(uniqid()) . '.' . strtolower($request->file('image')->getClientOriginalExtension());
            $request->file('image')->move('public/image/profile/', $doucments1);
            $file1 = 'public/image/profile/' . $doucments1;
            $company->image = $file1;
        } else {
            $company->image = "public/assets/images/1744022049828589.jpg";
        }
        $company->save();

        /* ------------------Assign role---------------------*/
        $role = Role::where('name', 'user')->first();
        $company->assignRole($role);

        /* ------------------Company save remaining data---------------------*/
        $user_company = new userCompany();
        if ($request->file('id_card')) {
            $doucments2 = hexdec(uniqid()) . '.' . strtolower($request->file('id_card')->getClientOriginalExtension());
            $request->file('id_card')->move('public/image/profile/', $doucments2);
            $file2 = 'public/image/profile/' . $doucments2;
            $user_company->id_card = $file2;
        }
        if ($request->file('image_license')) {
            $doucments3 = hexdec(uniqid()) . '.' . strtolower($request->file('image_license')->getClientOriginalExtension());
            $request->file('image_license')->move('public/image/profile/', $doucments3);
            $file3 = 'public/image/profile/' . $doucments3;
            $user_company->image_license = $file3;

        }

        $user_company->owner_name = $request->owner_name;
        $user_company->trading_license = $request->trading_license;
        $user_company->billing_area = $request->billing_area;
        $user_company->billing_city = $request->billing_city;
        $user_company->billing_address = $request->billing_address;
        $user_company->company_id = $company->id;
        $user_company->save();

        /* ---Send mail to the company for creating his new password-----*/
        $data['name'] = $company->name;
        $data['email'] = $company->email;
        $data['type'] = $company->type;
        $data['id'] = $company->id;
        if ($company) {
            Mail::to($company->email)->send(new Registration($data));

            return $this->message($company, 'admin.insurance.index', 'Company added Successfully', 'Company Update Error');
        } else {
            return redirect()->back()->with($this->data("Company Register Error", 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $company = User::with('insurance')->findOrFail($id);
        $page_title = 'company';
        return view('admin.insuranceCompany.edit', compact('company', 'page_title'));
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => 'required',
            'owner_name' => 'required',
            'trading_license' => 'required',
            'billing_area' => 'required',
            'billing_city' => 'required',
            'billing_address' => 'required',
        ]);
        $company = User::findOrFail($id);
        $company->name = $request->name;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->post_box = $request->post_box;
        $company->city = $request->city;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'), $filename);
            $company['image'] = 'public/images/' . $filename;
        }
        $company->save();
        $user_company = userCompany::where('company_id', $company->id)->first();
        if ($request->file('id_card')) {
            $images = [];
            foreach ($request->file('id_card') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/profile/', $image);
                $images[] = 'public/image/profile/' . $image;
            }
            $user_company->id_card = implode(",", $images);
        }
        if ($request->file('image_license')) {
            $images = [];
            foreach ($request->file('image_license') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/profile/', $image);
                $images[] = 'public/image/profile/' . $image;
            }
            $user_company->image_license = implode(",", $images);
        }
        $user_company->owner_name = $request->owner_name;
        $user_company->trading_license = $request->trading_license;
        $user_company->billing_area = $request->billing_area;
        $user_company->billing_city = $request->billing_city;
        $user_company->billing_address = $request->billing_address;
        $user_company->save();
        return $this->message($company, 'admin.insurance.index', 'Company Update Successfully', 'Company Update Error');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $company = User::findOrFail($id);
        if (Hash::check($request->old_password, $company->password)) {
            $company->password = bcrypt($request->password);
            $company->save();

            return redirect()->route('admin.insurance.index')->with($this->data("Update Insurance Company Password Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->data("Update Insurance Company Password Error", 'error'));
        }
    }

    public function activate($id)
    {
        $company = User::findOrFail($id);
        if ($company->action == 0) {
            $company->fill([
                'action' => 1,
            ])->save();
            $data['name'] = $company->name;
            $data['data'] = 'Congratulation! Your account has been activated. Now you can login your account as an Insurance Company';

            Mail::to($company->email)->send(new AccountStatus($data));
            return redirect()->route('admin.insurance.index')->with($this->data("Insurance Company Activated Successfully", 'success'));
        } else {
            return redirect()->back()->with($this->data("Insurance Company Activate Error", 'error'));
        }
    }

    public function deactivate(Request $request)
    {
        $company = User::find($request->user_id);
        if ($company->action == 1) {
            $company->fill([
                'action' => 0,
            ])->save();

            $data['name'] = $company->name;
            $data['data'] = "Your Account has been Deactivated due to the below reason:";
            $data['reason'] = $request->comment_val;
            Mail::to($company->email)->send(new AccountStatus($data));
            $message = 'Rejection message send successfully!';
            return response()->json([

                'success' => 'Company DeActivated Successfully',
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'success' => 'DeActivate Error',
            ]);
        }
        //     return redirect()->route('admin.insurance-company')->with($this->data("Insurance Company DeActivate Successfully", 'success'));
        // } else {
        //     return redirect()->back()->with($this->data("Insurance Company DeActivate Error", 'error'));
        // }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $company = User::findOrFail($id);
        $company->delete();
        return $this->message($company, 'admin.insurance.index', 'Insurance Company Deleted successfully', 'Insurance Company Delete Error');
    }
}
