<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $brands = Brand::all();
        $page_title = 'Brand';
        return view('admin.brand.index', compact('brands', 'page_title'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //'image' => 'mimes:jpg,jpeg,png',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = str_replace(' ', '_', strtolower($request->name));
        /*if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/brand/', $image_name);
            $image = 'public/image/brand/' . $image_name;
            $brand->image = $image;
        }*/
        $brand->save();
        return $this->message($brand, 'admin.brand.index', 'Brand Create Successfully', 'Brand Create Error');
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
     * @param Brand $brand
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Brand $brand)
    {
        $page_title = 'Edit Brand';
        return view('admin.brand.edit', compact('brand', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            //'image' => 'mimes:jpg,jpeg,png',
        ]);
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = str_replace(' ', '_', strtolower($request->name));
        /*if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/brand/', $image_name);
            $image = 'public/image/brand/' . $image_name;
            $old_image = $request->old_image;
            unlink($old_image);
            $brand->image = $image;
        }*/
        $brand->save();
        return $this->message($brand, 'admin.brand.index', 'Brand Update Successfully', 'Brand Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        //unlink($brand->image);
        $brand->delete();
        return $this->message($brand, 'admin.brand.index', 'Brand Delete Successfully', 'Brand Delete Error');
    }
}
