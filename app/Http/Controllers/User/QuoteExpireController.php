<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\ExpireQuote;
use App\Models\UserBid;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuoteExpireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delete = Carbon::now()->subDays(8);
        $warning = Carbon::now()->subDays(7);

        $deleteQuote = UserBid::with('vendorBid', 'user')->where('created_at', '<', $delete)->whereHas('vendorBid')->get();
        foreach ($deleteQuote as $quote) {
            $data['body1'] = "Your Quote ".$quote->reference_no. " has been deleted because multipe Garages place a bid on your Quote  but did't accept. we already notify you 24 hour ago.";
            $data['name'] = $quote->user->name;
            $data['email'] = 'arshadfaarsi13@gmail.com';
            $data['link'] = url('user/quoteindex');

            $ExpireQuote = new ExpireQuote($data);
            dispatch($ExpireQuote);
        }

        $warningQuote = UserBid::with('vendorBid', 'user')->where('created_at', '<', $warning)->whereHas('vendorBid')->get();
        foreach ($warningQuote as $quote) {
            $data['body1'] = "Garages palace a bid on your Quote ";
            $data['body2'] = "accepte it otherwise your quote has been deleted after 24 hour. ";
            $data['name'] = $quote->user->name;
            $data['email'] = 'arshadfaarsi13@gmail.com';
            $data['link'] = url('user/response', $quote->id);
            $data['reference'] = $quote->reference_no;

            $ExpireQuote = new ExpireQuote($data);
            dispatch($ExpireQuote);
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
