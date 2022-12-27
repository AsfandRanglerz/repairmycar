<?php

namespace App\Http\Controllers\User;

use App\Models\Ads;
use App\Models\Company;
use App\Models\CarModel;
use App\Models\ModelYear;
use App\Jobs\Notification;
use Illuminate\Http\Request;
use App\Models\webNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $ads = Ads::where('user_id', auth()->id())->with('company', 'modelYear')->orderBy('id','desc')->paginate(5);
        return view('user.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        $model = CarModel::all();
        $year = ModelYear::all();
        $page_title = 'Ad index';
        return view('user.ads.create', compact('company', 'year','model','page_title'));
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
            'city' => 'required',
            'car_images' => 'required',
            'document' => 'required',
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
        $ads = new Ads();
        if ($request->file('car_images')) {
            $images = [];
            foreach ($request->file('car_images') as $data) {
                $image = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/add/', $image);
                $images[] = 'public/image/add/' . $image;
            }
            /*if ($request->has('old_image')) {
            $old_image = $request->image;
            unlink($old_image);
            }*/
            $ads->images = implode(",", $images);
        }
        if ($request->file('document')) {
            $files = [];
            foreach ($request->file('document') as $data) {
                $doucments = hexdec(uniqid()) . '.' . strtolower($data->getClientOriginalExtension());
                $data->move('public/image/add/', $doucments);
                $files[] = 'public/image/add/' . $doucments;
            }

            /*if ($request->has('old_image')) {
            $old_image = $request->image;
            unlink($old_image);
            }*/
            $ads->document_file = implode(",", $files);
        }
        $ads->model = $request->model;
        $ads->company_id = $request->company_id;
        $ads->model_year_id = $request->model_year_id;
        $ads->price = $request->price;
        $ads->color = $request->color;
        $ads->engine = $request->engine;
        $ads->phone = $request->phone;
        $ads->landline_no = $request->landline_no;
        $ads->address = $request->address;
        $ads->mileage = $request->mileage;
        $ads->city = $request->city;
        $ads->country = $request->country;
        $ads->description = $request->description;
        $ads->user_id = Auth::id();
        // please correect this
        $ads->save();

        $message['email'] = auth()->user()->email;
        $message['type'] = "ads";
        $message['link1'] = url('user/ads');
        //mail notification
        $Notification = new Notification($message);
        dispatch($Notification);
        //web notification
        $notification = new webNotification();
        $notification->customer_id = auth()->user()->id;
        $notification->title = " Advertisement Placement Completed ";
        $notification->links = url('user/ads');
        $notification->body = ' ';
        $notification->save();
        // session_start();
        $_SESSION["msg"] = "Ad Created Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.ads.index');
        // return $this->message($ads, 'user.ads.index', 'Ad Created Successfully', 'Ads Create Error');
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
        $ads = Ads::findOrFail($id);
        $model = CarModel::all();
        $company = Company::all();
        $year = ModelYear::all();
        return view('user.ads.edit', compact('ads', 'company', 'year','model'));
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
        // return $request;
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

        //update car images
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
        $ads->landline_no = $request->landline_no;
        $ads->address = $request->address;
        $ads->mileage = $request->mileage;
        $ads->city = $request->city;
        $ads->country = $request->country;
        $ads->description = $request->description;
        $ads->user_id = Auth::id();
        $ads->update();

        $_SESSION["msg"] = "Ad Updated Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.ads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ads::findOrFail($id);
        $ad->delete();

        $_SESSION["msg"] = "Ad Deleted Successfully";
        $_SESSION["alert"] = "success";
        return redirect()->route('user.ads.index');
       
    }
}
