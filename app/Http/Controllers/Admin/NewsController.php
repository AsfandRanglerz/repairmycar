<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $news = News::all();
        $page_title = 'News';
        return view('admin.news.index', compact('news', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $page_title = 'Create News';
        return view('admin.news.create', compact('page_title'));
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        $news = new News();
        $news->title = $request->title;
        $news->slug = str_replace(' ', '_', strtolower($request->title));
        $news->description = $request->description;
        if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/news/', $image_name);
            $image = 'public/image/news/' . $image_name;
            $news->image = $image;
        }
        $news->save();
        return $this->message($news, 'admin.news.index', 'News Create Successfully', 'News Create Error');
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
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(News $news)
    {
        $page_title = "Edit News";
        return view('admin.news.edit', compact('news', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        $data = $news;
        $data->title = $request->title;
        $data->slug = str_replace(' ', '_', strtolower($request->title));
        $data->description = $request->description;
        if ($request->has('image')) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
            $image->move('public/image/news/', $image_name);
            $image = 'public/image/news/' . $image_name;
            $old_image = $request->old_image;
            if (isset($old_image)) {
                unlink($old_image);
            }
            $data->image = $image;
        }
        $data->save();
        return $this->message($data, 'admin.news.index', 'News Update Successfully', 'News Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News  $news
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        News::destroy($id);
        // dd('done');
        return redirect()->route('admin.news.index')->with($this->data("News deleted successfyully", 'success'));
    }
}
