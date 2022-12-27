<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subcategories = SubCategory::get();
        $categories = Category::get();
        $page_title = 'SubCategory';
        return view('admin.subcategory.index', compact('subcategories', 'categories', 'page_title'));
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
            'category_id' => 'required',
        ]);
        /*if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/subcategory/', $image_name);
            $image = 'public/image/subcategory/' . $image_name;
        }*/
        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = str_replace(' ', '_', strtolower($request->name));
        /*$subcategory->image = $image;*/
        $subcategory->save();
        return $this->message($subcategory, 'admin.subcategory.index', 'SubCategory Create Successfully', 'SubCategory Create Error');
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
        $subcategory = SubCategory::with('parent')->findOrFail($id);
        $categories = Category::get();
        $page_title = 'Edit SubCategory';
        return view('admin.subcategory.edit', compact('subcategory', 'categories', 'page_title'));
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
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = str_replace(' ', '_', strtolower($request->name));
        $subcategory->save();
        if ($subcategory) {
            return redirect()->route('subcategory.index')->with($this->message('Update SubCategory Successfully', 'success'));
        } else {
            return redirect()->back()->with($this->message('Update SubCategory Error', 'error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        if ($subcategory) {
            return redirect()->route('subcategory.index')->with($this->message('Delete SubCategory Successfully', 'success'));
        } else {
            return redirect()->route('subcategory.index')->with($this->message('Delete SubCategory Error', 'error'));
        }
    }
}
