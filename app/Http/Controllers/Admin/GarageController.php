<?php

namespace App\Http\Controllers\Admin;

use App\Models\Garage;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\GarageCategory;
use App\Models\PaymentPercentage;
use App\Http\Controllers\Controller;
use App\Http\Requests\GarageRequest;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $garages = Garage::all();
        $garages->each(function ($c) {$c->load(['garageCategory' => function ($q) {$q->limit(5);}]);});
        $page_title = 'Garages';
        return view('admin.garage.index', compact('garages', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $page_title = 'Create Garage';
        $vendor = Vendor::doesntHave('garage')->get();
        $category = Category::all();
        $vat=PaymentPercentage::where('type','vat')->first();
        return view('admin.garage.create', compact('page_title', 'vendor', 'category','vat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GarageRequest $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/garage/', $image_name);
            $image = 'public/image/garage/' . $image_name;
        }
        $data = $request->only(['vendor_id', 'garage_name', 'trading_no', 'vat', 'phone', 'address', 'country', 'city', 'post_box', 'image', 'description']);
        $data['image'] = $image ?? '';
        $garage = Garage::create($data);
        //dd($request->category_id);
        foreach ($request->category_id as $category) {
            GarageCategory::create([
                'garage_id' => $garage->id,
                'category_id' => $category,
            ]);
        }
        return $this->message($garage, 'admin.garage.index', 'Garage Create Successfully', 'Garage Create Error');
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
     * @param Garage $garage
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Garage $garage)
    {
        $page_title = 'Edit Garage';
        $category = Category::all();
        $garage_category1 = GarageCategory::where('garage_id', $garage->id)->get();
        $garage_category = [];
        foreach ($garage_category1 as $data) {
            $garage_category[] = $data->id;
        }
        return view('admin.garage.edit', compact('page_title', 'category', 'garage', 'garage_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Garage $garage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GarageRequest $request, Garage $garage)
    {
        $request->validate([
            'garage_name' => ['required', 'string', 'max:255'],
            'trading_no' => 'required',
            'vat' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'post_box' => 'required',
            'address' => 'required',
        ]);
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/garage/', $image_name);
            $image = 'public/image/garage/' . $image_name;
        } else {
            $image = $request->old_image;
        }
        $garage_id = $garage->id;
        $data = $request->only(['garage_name', 'trading_no', 'vat', 'phone', 'address', 'country', 'city', 'post_box', 'image', 'description']);
        $data['image'] = $image ?? '';
        $garage = $garage->update($data);
        $data['image'] = $image ?? '';
        $garage_category = GarageCategory::where('garage_id', $garage_id)->whereNotIn('category_id', $request->category_id)->get();
        if (!$garage_category->isEmpty()) {
            $garage_category->each->delete();
        }
        foreach ($request->category_id as $category) {
            GarageCategory::updateOrCreate([
                'garage_id' => $garage_id,
                'category_id' => $category,
            ]);
        }
        return $this->message($garage, 'admin.garage.index', 'Garage Update Successfully', 'Garage Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Garage $garage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Garage::destroy($id);
        return redirect()->route('admin.garage.index')->with($this->data("Garage deleted successfyully", 'success'));
    }
}
