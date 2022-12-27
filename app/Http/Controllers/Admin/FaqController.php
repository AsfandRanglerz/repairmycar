<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $data = Faq::all();
        return view('admin/faq/index', compact('data'));
    }
    public function get_add_faq()
    {
        return view('admin/faq/add');
    }
    public function add_faq(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $data = new Faq;
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();
        return redirect('admin/faqs')->with($this->data("Faq added succesfully", 'success'));;
    }
    public function delete_faq($id)
    {
        Faq::destroy($id);
        return redirect('admin/faqs')->with($this->data("Faq deleted successfully", 'success'));
    }
    public function edit_faq($id)
    {
        $data = Faq::find($id);
        return view('admin/faq/edit', compact('data'));
    }
    public function update_faq(Request $request,$id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $data = Faq::find($id);
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();
        return redirect('admin/faqs')->with($this->data("Faq updated successsfully", 'success'));
    }
}
