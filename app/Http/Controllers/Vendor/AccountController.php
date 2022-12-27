<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Garage;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::guard('vendor')->user()->id;
        $request = WithdrawRequest::where('status', 0)->where('vendor_id', $auth_id)->sum('balance');
        $withdraw = WithdrawRequest::where('status', 1)->where('vendor_id', $auth_id)->sum('balance');
        $garage = Garage::where('vendor_id', $auth_id)->first();
        $pending = Order::where("status", "pending")->where("garage_id", $garage->id)->sum('advance');
        $pending1 = Order::where("status", "pending")->where("garage_id", $garage->id)->Where('paid_by', 'insurance')->sum('total');
        $pending = $pending + $pending1;
        return view('vendor.Account.index', compact('request', 'withdraw', 'pending'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = Account::where('vendor_id', Auth::guard('vendor')->user()->id)->first();
        if (!empty($account)) {
            return view('vendor.Account.edit', compact('account'));
        } else {

            return view('vendor.Account.bank-detail');
        }
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
            'name' => 'required',
            'bank_name' => 'required',
            'iban' => 'required',
        ]);
        $account = new Account();
        $account->vendor_id = Auth::guard('vendor')->user()->id;
        $account->owner_name = $request->name;
        $account->bank_name = $request->bank_name;
        $account->iban = $request->iban;
        $account->save();

        // session_start();
        $_SESSION["msg"] = "Your Finance detail has been added";
        $_SESSION["alert"] = "success";
        return redirect()->route('vendor.acount.index');
        // return redirect()->route('vendor.acount.index')->with($this->data("Your Finance detail has been added", 'success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request)
    {
        if ($request->payment == null || $request->payment == ' ') {
            return back()->with($this->data(" Faild! Please select a valid Amount", 'error'));
        }
        $account = Account::where('vendor_id', Auth::guard('vendor')->user()->id)->first();
        if (empty($account)) {

            // session_start();
            $_SESSION["msg"] = "Please Add Your Finance Detail First!";
            $_SESSION["alert"] = "error";
            return redirect()->route('vendor.acount.create');
            // return redirect()->route('vendor.acount.create')->with($this->data("Please Add Your Finance Detail First!", 'error'));
        }
        $vendor = Vendor::find(Auth::guard('vendor')->user()->id);

        $data = new WithdrawRequest();
        $data->vendor_id = Auth::guard('vendor')->user()->id;
        $data->owner_name = $account->owner_name;
        $data->bank_name = $account->bank_name;
        $data->iban = $account->iban;
        $data->balance = $request->payment;
        $data->deduction = $request->deduction;
        $data->recieved = $request->receive;
        $data->save();
        $vendor->balance = $vendor->balance - $request->payment;
        $vendor->save();

        // session_start();
        $_SESSION["msg"] = "Your withdrawl request has been submitted";
        $_SESSION["alert"] = "success";
        return redirect()->route('vendor.acount.index');
        // return redirect()->route('vendor.acount.index')->with($this->data("Your withdrawl request has been submitted", 'success'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bank_name' => 'required',
            'iban' => 'required',
        ]);
        $account = Account::where('vendor_id', Auth::guard('vendor')->user()->id)->first();
        $account->owner_name = $request->name;
        $account->bank_name = $request->bank_name;
        $account->iban = $request->iban;
        $account->save();
        return redirect()->route('vendor.acount.index');
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
