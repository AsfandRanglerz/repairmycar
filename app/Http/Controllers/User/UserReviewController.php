<?php

namespace App\Http\Controllers\User;

use App\Models\Garage;
use App\Models\UserReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $review = new UserReview();
            $review->user_id = auth()->id();
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->garage_id  = $request->garage_id;
            $review->order_id  = $request->order_id;
            $review->save();

            $rating = UserReview::where('garage_id',$request->garage_id)->avg('rating');
            $garage = Garage::find($request->garage_id);
            $garage->update([
                'rating' => $rating
            ]);
           
            // session_start();
            $_SESSION["msg"] = "Thanks for submitting your review";
            $_SESSION["alert"] = "success";
            return redirect()->back();
            // return back()->with($this->data("Thanks for submit your review", 'success'));
            // return $this->message($review, 'user.order.index', 'Thanks for submit your review', 'Failed to submit review');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function show(UserReview $userReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function edit(UserReview $userReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserReview $userReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserReview $userReview)
    {
        //
    }
}
