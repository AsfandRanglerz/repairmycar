<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacyPolicy = PrivacyPolicy::find(1);
        $page_title = 'Privacy Policy';
        return view('admin.privacyPolicy.index', compact('privacyPolicy', 'page_title'));
    }

    public function edit($id)
    {
        $privacyPolicy = PrivacyPolicy::find($id);
        $page_title = 'Edit Privacy Policy';
        return view('admin.privacyPolicy.edit', compact('privacyPolicy', 'page_title'));
    }

    public function update(Request $request, $id){

        $privacyPolicy = PrivacyPolicy::where('id', $id)->update([
            'description' => $request->description
        ]);
        return $this->message($privacyPolicy, 'admin.privacyPolicy.index', 'Privacy Policy Update Successfully', 'Privacy Policy Update Error');

    }
}
