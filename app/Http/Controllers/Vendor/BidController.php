<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    
   public function getBids(){
    if(isset(Auth::user()->garage->id)){
        $data=VendorBid::where('garage_id',Auth::user()->garage->id)->with('userBid')->orderBy('id','desc')->paginate(5);
        }else{
          $data=[];
         }
       return view('vendor.bids.my_bid',compact('data'));
   }
   
   public function bidDetails($id){
      $data=VendorBid::find($id);
      return view('vendor.bids.bid_detail',compact('data'));
   }
}
