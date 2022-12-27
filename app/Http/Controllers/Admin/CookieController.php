<?php

namespace App\Http\Controllers\Admin;

use App\Models\CookiePolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CookieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cookiePolicy = CookiePolicy::find(1);
        $page_title = 'Cookies Policy';
         return view('admin.cookiePolicy.index', compact('cookiePolicy', 'page_title'));
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
        $CookiesPolicy = CookiePolicy::find($request->id);
        $CookiesPolicy->description = $request->description;
        $CookiesPolicy->save();
        
        $cookiePolicy = CookiePolicy::find(1);
        return view('admin.cookiePolicy.index', compact('cookiePolicy', 'CookiesPolicy'))->with($this->data("Cookie Policy has been Updated successfyully", 'success'));
        
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
        $cookiePolicy = CookiePolicy::find($id);
        $page_title = 'Edit Privacy Policy';
        return view('admin.cookiePolicy.edit', compact('cookiePolicy', 'page_title'));
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
