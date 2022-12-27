<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AddPackage;
use App\Models\SimpleAd;
use Illuminate\Http\Request;

class SimpleAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $package = AddPackage::all();
        return view('web.simpleAds', compact('package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ad = new SimpleAd();
        $ad->email = $request->email;
        $ad->url = $request->url;
        $ad->description = $request->description;
        $ad->packages_id = $request->package;

        if ($request->file('image')) {
            $name = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $name = $request->file('image')->move('public/image/add/', $name);
            $ad->image = $name;
        }
        $ad->save();
        
        $_SESSION["msg"] = "Your Ad Request has been sent, soon you'll be notify through an email";
        $_SESSION["alert"] = "success";
        return redirect()->route('home');
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

    public function package(Request $request)
    {
        $data = AddPackage::find($request->id);
        return response()->json([
            'success' => 'successfully',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
