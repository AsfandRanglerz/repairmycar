<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register()
    {
        $page_title = 'Admin Register';
        return view('admin.auth.register', compact('page_title'));
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'phone' => 'required|unique:admins,phone',
            'password' => ['required', 'confirmed',],
        ]);
        $role = Role::where('name', 'admin')->first();
        $admin = new  User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = bcrypt($request->password);
        $admin->save();
        $admin->assignRole($role);
        return $this->message($admin, 'admin.register', 'Admin Register Successfully', 'Admin Register Error');
    }

    public function login()
    {
        $page_title = 'Admin Login';
        return view('admin.auth.login', compact('page_title'));
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin_role = Auth::guard('admin')->user()->hasRole('admin');
            return $this->message($admin_role, 'admin.dashboard', 'Admin Login Successfully', 'Admin Login Error');
        }
        return redirect()->back()->with($this->data("Admin Email Or Password Invalid!", 'error'));

    }

    public function forgetPassword()
    {
        $page_title = 'Forget Password';
        return view('admin.auth.forget_password', compact('page_title'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:admins,email',
        ]);
        $page_title = 'Otp Confirm';
        $admin = Admin::where('email', $request->email)->first();
        $otp = mt_rand(10000, 99999);
        $email = $admin->email;
        $details['otp'] = $otp;
        try {
            Mail::to($request->email)->send(new ResetPassword($details));
        } catch (\Swift_TransportException $e) {
            if ($e->getMessage()) {
                dd($e->getMessage());
            }
        }
        DB::table('password_resets')->insert([
            'email' => $admin->email,
            'otp' => $otp,
            'created_at' => Carbon::now()
        ]);
        return view('admin.auth.otp', compact('page_title', 'email'));
    }

    public function otpConfirm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
            'otp' => 'required',
        ]);
        $page_title = 'Update Password';
        $admin = Admin::where('email', $request->email)->first();
        $email = $admin->email;
        $otp_confirm = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'otp' => $request->otp
            ])
            ->first();
        if (!$otp_confirm) {
            return redirect()->back()->with('OTP not same!');
        }

        return view('admin.auth.password_change', compact('page_title', 'email'));
    }

    /**
     * Write code on Method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $admin = Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return $this->message($admin, 'admin.login', 'Your Password Update Successfully', 'Password Update Error');
    }

    public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->logout();
        return $this->message($admin, 'admin.login', 'Admin Logout Successfully', 'Admin Logout Error');
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        $page_title = 'Admin Profile';
        return view('admin.profile', compact('admin', 'page_title'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => 'required',
        ]);
        $admin = Admin::findorFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        // return $request;
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('public/image/profile/', $filename);
            $admin->image = 'public/image/profile/' . $filename;
        }
        $admin->update();
        return $this->message($admin, 'admin.profile', 'Admin Profile Update Successfully', 'Admin Profile Error');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $admin = Admin::findOrFail($id);
        if (Hash::check($request->old_password, $admin->password)) {
            // $admin->fill([
            //     'password' => Hash::make($request->password)
            // ])->save();
            Admin::where('id', $admin->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return $this->message($admin, 'admin.profile', 'Admin Profile Password Update Successfully', 'Profile Update Error');
        } else {
            return redirect()->back()->with($this->data("Update Password Error", 'error'));
        }
    }
}
