<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::find(1);
        $page_title = "About Us";
        return view('admin.about.index', compact('about', 'page_title'));
    }

    public function edit($id)
    {
        $about = About::find($id);
        $page_title = "Edit About Us";
        return view('admin.about.edit', compact('about', 'page_title'));
    }

    public function update(Request $request, $id){

        $about = About::where('id', $id)->update([
            'description' => $request->description
        ]);
        return $this->message($about, 'admin.about.index', 'About Page Update Successfully', 'About Page Update Error');
    }

    public function show()
    {
        $about = About::find(1);
        $page_title = "About Us";
        return view('admin.about.show', compact('about', 'page_title'));
    }
}
