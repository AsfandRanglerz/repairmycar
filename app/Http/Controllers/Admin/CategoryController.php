<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use phpseclib3\Crypt\EC\Formats\Keys\Common;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::orderby('position','ASC')->get();
        $page_title = 'Category';
        return view('admin.category.index', compact('categories', 'page_title'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png,PNG',
            'icon' => 'mimes:jpg,jpeg,png,svg',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_replace(' ', '_', strtolower($request->name));
        if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/category/', $image_name);
            $image = 'public/image/category/' . $image_name;
            $category->image = $image;
        }
        if ($request->has('icon')) {
            $icon = $request->file('icon');
            $icon_name = hexdec(uniqid()) . '.' . strtolower($icon->getClientOriginalExtension());
            $icon->move('public/image/category/', $icon_name);
            $icon = 'public/image/category/' . $icon_name;
            $category->icon = $icon;
        }
        $category->save();
        return $this->message($category, 'admin.category.index', 'Category Create Successfully', 'Category Create Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $category = Category::findOrFail($id);
        $page_title = 'Edit Category';
         return view('admin.category.edit', compact('category', 'page_title'));
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
            'image' => 'mimes:jpg,jpeg,png',
            'icon' => 'mimes:jpg,jpeg,png,svg',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str_replace(' ', '_', strtolower($request->name));
        if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/category/', $image_name);
            $image = 'public/image/category/' . $image_name;
            $old_image = $request->old_image;
//            unlink($old_image);
            $category->image = $image;
        }
        if ($request->has('icon')) {
            $icon = $request->file('icon');
            $icon_name = hexdec(uniqid()) . '.' . strtolower($icon->getClientOriginalExtension());
            $icon->move('public/image/category/', $icon_name);
            $icon = 'public/image/category/' . $icon_name;
            $old_icon = $request->old_icon;
//            unlink($old_image);
            $category->icon = $icon;
        }
        $category->save();
        return $this->message($category, 'admin.category.index', 'Category Update Successfully', 'Category Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function destroy($id)
    // {
    //     $category = Category::findOrFail($id);
    //     //unlink($category->image);
    //     $category->delete();
    //     return $this->message($category, 'admin.category.index', 'Category Delete Successfully', 'Category Delete Error');
    // }
    public function delete($id)
    {
        Category::destroy($id);
        // dd('done');
        return redirect()->route('admin.category.index')->with($this->data("Service deleted successfyully", 'success'));
    }




    public function orderUpdate(Request $request){
        $category = Category::all();
      foreach ($category as $product) {
          foreach ($request->order as $order) {
              if ($order['id'] == $product->id) {
                  $product->update(['position' => $order['position']]);
              }
          }
      }
       return response()->json([
            'success' => 'Status updated successfully',
        ]);
    }



}
