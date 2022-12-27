<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $childcategories = ChildCategory::with('parentSub')->get();
        $subcategories = SubCategory::get();
        $page_title = 'ChildCategory';
        return view('admin.childcategory.index', compact('subcategories', 'childcategories', 'page_title'));
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
            'subcategory_id' => 'required',
        ]);
        /*if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/subcategory/', $image_name);
            $image = 'public/image/subcategory/' . $image_name;
        }*/
        $childcategory = new ChildCategory();
        $childcategory->subcategory_id = $request->subcategory_id;
        $childcategory->name = $request->name;
        $childcategory->slug = str_replace(' ', '_', strtolower($request->name));
        /*$childcategory->image = $image;*/
        $childcategory->save();
        return $this->message($childcategory, 'admin.childcategory.index', 'ChildCategory Create Successfully', 'ChildCategory Create Error');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $childcategory = ChildCategory::with('parentSub')->findOrFail($id);
        $subcategories = SubCategory::get();
        $page_title = 'Edit ChildCategory';
        return view('admin.childcategory.edit', compact('childcategory', 'subcategories', 'page_title'));
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
        ]);
        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->subcategory_id = $request->subcategory_id;
        $childcategory->name = $request->name;
        $childcategory->slug = str_replace(' ', '_', strtolower($request->name));
        $childcategory->save();
        return $this->message($childcategory, 'admin.childcategory.index', 'ChildCategory Update Successfully', 'ChildCategory Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $childcategory = ChildCategory::findOrFail($id);
//        unlink($childcategory->image);
        $childcategory->delete();
        return $this->message($childcategory, 'admin.childcategory.index', 'ChildCategory Delete Successfully', 'ChildCategory Delete Error');
    }
}
