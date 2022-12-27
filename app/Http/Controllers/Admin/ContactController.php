<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::find(1);
        $page_title = "Contact";
        return view('admin.contact.index', compact('contact', 'page_title'));
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        $page_title = "Edit Contact";
        return view('admin.contact.edit', compact('contact', 'page_title'));
    }

    public function update(Request $request, $id){
        $contact = Contact::find($id)->update([
            'description' => $request->description
        ]);
        return $this->message($contact, 'admin.contact.index', 'Contact Update Successfully', 'Contact Update Error');
    }
}
