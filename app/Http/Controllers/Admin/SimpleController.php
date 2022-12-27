<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Mail\SimpleAd;
use App\Models\AddPackage;
use App\Models\SimpleAd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SimpleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['ads'] = SimpleAd::all();
        $data['page_title'] = 'Ads';
        return view('admin.simpleAds.index', $data);
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
        $packages = AddPackage::find($id);
        return view('admin.simpleAds.edit', compact('packages'));
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
        $package = AddPackage::find($id);
        $package->package_name = $request->package_name;
        $package->price = $request->price;
        $package->validity = $request->validity;
        $package->save();

        return redirect()->route('admin.all-packages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id)
    {
        $ad = SimpleAd::find($id);
        $ad->delete();
        return redirect()->back();
    }

    public function package()
    {
        $data['page_title'] = 'packages';
        $data['packages'] = AddPackage::all();
        return view('admin.simpleAds.package', $data);
    }

    public function status($id)
    {
        $ad = SimpleAd::with('package')->find($id);
        if ($ad->status == 'Pending') {
            $ad->status = 'Approved';
            $validity = $ad->package->validity;
            $ad->validity = Carbon::now()->addDays($validity);
            $ad->save();
            $data['content'] = 'Congratulations! Your Ad has been Published Successfully on Repair My Car Portal';
            Mail::to($ad->email)->send(new \App\Mail\SimpleAd($data));
        }

        return redirect()->back()->with($this->data("Status Successfully Updated", 'success'));
    }

}
