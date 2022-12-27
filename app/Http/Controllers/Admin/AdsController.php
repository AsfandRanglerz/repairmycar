<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendApprovedMail;
use App\Models\Ads;
use App\Models\Company;
use App\Models\ModelYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::with('company', 'modelYear', 'user', 'vendor')->orderBy('id', 'desc')->get();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
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
        $ads = Ads::with('company', 'modelYear')->find($id);
        $company = Company::all();
        $year = ModelYear::all();
        return view('admin.ads.edit', compact('ads', 'company', 'year'));

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
        $request->validate([
            'model' => 'required',
            'company_id' => 'required',
            'model_year_id' => 'required',
            'price' => 'required',
            'color' => 'required',
            'engine' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'mileage' => 'required',
        ]);
        $ads = Ads::findOrFail($id);
        if ($request->file('car_images')) {
            $images = [];
            foreach ($request->file('car_images') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/add/', $image);
                $images[] = 'public/image/add/' . $image;
            }
            $new = implode(",", $images);
            if (isset($request->car_old)) {
                $old = implode(",", $request->car_old);
                $ads->images = $old . "," . $new;
            } else {
                $ads->images = $new;
            }
        } else {
            if (isset($request->car_old)) {
                $old = implode(",", $request->car_old);
                $ads->images = $old;
            } else {
                $ads->images = " ";
            }
        }

        //update car documents
        if ($request->file('document')) {
            $files = [];
            foreach ($request->file('document') as $data) {
                $doucments = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/add/', $doucments);
                $files[] = 'public/image/add/' . $doucments;
            }
            $new = implode(",", $files);
            if (isset($request->doc_old)) {
                $old = implode(",", $request->doc_old);
                $ads->document_file = $old . "," . $new;
            } else {
                $ads->document_file = $new;
            }
        } else {
            if (isset($request->doc_old)) {
                $old = implode(",", $request->doc_old);
                $ads->document_file = $old;
            } else {
                $ads->document_file = "";
            }
        }
        $ads->model = $request->model;
        $ads->company_id = $request->company_id;
        $ads->model_year_id = $request->model_year_id;
        $ads->price = $request->price;
        $ads->color = $request->color;
        $ads->engine = $request->engine;
        $ads->phone = $request->phone;
        $ads->address = $request->address;
        $ads->mileage = $request->mileage;
        $ads->city = $request->city;
        $ads->country = $request->country;
        $ads->description = $request->description;
        $ads->update();
        // if ($request->file('car_images')) {
        //     $images = [];
        //     foreach ($request->file('car_images') as $data) {
        //         $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
        //         $data->move('public/image/add/', $image);
        //         $images[] = 'public/image/add/' . $image;
        //     }
        //     $ads->images = implode(",", $images);
        // }
        // //update car documents
        // if ($request->file('document')) {
        //     $files = [];
        //     foreach ($request->file('document') as $data) {
        //         $doucments = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
        //         $data->move('public/image/add/', $doucments);
        //         $files[] = 'public/image/add/' . $doucments;
        //     }
        //     $ads->document_file = implode(",", $files);
        // }
        // $ads->save();
        return $this->message($ads, 'admin.ads.index', 'Ad Successfully Updated', '  Ad is not update Error');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAds($id)
    {
        $ad = Ads::find($id);
        $ad->delete();
        return redirect()->back()->with($this->data("Ads Successfully Deleted", 'success'));

    }

    public function statusAds($id)
    {
        $ad = Ads::with('user')->find($id);
        if ($ad->status == 'Pending') {
            $ad->status = 'Approved';
        } elseif ($ad->status == 'Approved') {
            $ad->status = 'Rejected';
        } else {
            $ad->status = 'Approved';
        }
        $ad->save();

        if ($ad->status == 'Approved') {
            if (isset($ad->user_id)) {
                $email = $ad->user->email;
            } else {
                $email = $ad->vendor->email;
            }
            $data = $ad;
            Mail::to($email)->send(new SendApprovedMail($data));
        }
        return redirect()->back()->with($this->data("Status Successfully Updated", 'success'));
    }

}
