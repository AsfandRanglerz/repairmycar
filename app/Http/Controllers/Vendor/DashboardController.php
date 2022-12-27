<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use App\Models\Order;
use App\Models\UserReview;
use App\Models\Vendor;
use App\Models\TermCondition;
use App\Models\PrivacyPolicy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title = 'Vendor Dashboard';
        $vendor_garage = Garage::where('vendor_id',auth()->id())->first();
        $completedOrders = Order::where([['status','complete'],['garage_id',$vendor_garage->id]])->count();
        $totalReviews = UserReview::where('garage_id',$vendor_garage->id)->count();
        $rating= UserReview::where('garage_id',$vendor_garage->id)->sum('rating');
        if($totalReviews ==0 && $rating ==0)
        {
            $overAllRatings = 0;
        }else{
            $overAllRatings = $rating/$totalReviews;
        }
        $order = Order::where('garage_id',$vendor_garage->id)->latest()->first();
        
        $data['policy'] =  PrivacyPolicy::first();
        $data['terms'] = TermCondition::first();

        /*$dateFrom = Carbon::now()->subDays(30);
        $dateTo = Carbon::now();
        //monthlyRevenue = PaymentTransactions::whereNotNull('created_at')->whereBetween('created_at', [$dateFrom, $dateTo])->sum('amount');
        $monthlyRevenue = 0;
        $monthlyVendor = Vendor::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->whereNotNull('created_at')->whereBetween('created_at', [$dateFrom, $dateTo])->count();
        //$monthlyOrder = packageSubscription::whereNotNull('created_at')->whereBetween('created_at', [$dateFrom, $dateTo])->count();
        $monthlyOrder = 0;

        $previousDateFrom = Carbon::now()->subDays(60);
        $previousDateTo = Carbon::now()->subDays(31);
        //$previousMonthlyRevenue = PaymentTransactions::whereNotNull('created_at')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('amount');
        $previousMonthlyRevenue = 0;
        $previousMonthlyVendor = Vendor::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->whereNotNull('created_at')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();
        $previousMonthlyOrder = Vendor::whereNotNull('created_at')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();*/

        // Revenue  //
        /*if ($previousMonthlyRevenue > 0 && $monthlyRevenue > 0) {
            if ($previousMonthlyRevenue < $monthlyRevenue) {
                if ($previousMonthlyRevenue > 0) {
                    $percent_from = $monthlyRevenue - $previousMonthlyRevenue;
                    $percentRevenue = $percent_from / $previousMonthlyRevenue * 100; //increase percent
                } else {
                    $percentRevenue = 100; //increase percent
                }
            } else {
                $percent_from = $previousMonthlyRevenue - $monthlyRevenue;
                $percentRevenue = $percent_from / $previousMonthlyRevenue * 100; //decrease percent
            }
        } else {
            $percent_from = 0;
            $percentRevenue = 100;
        }*/

        // Vendor  //

        //return view('vendor.index', compact('page_title', 'monthlyRevenue', 'previousMonthlyRevenue', 'monthlyVendor', 'previousMonthlyVendor', 'monthlyOrder', 'previousMonthlyOrder'));
    return view('vendor.index', compact('page_title','completedOrders','totalReviews','overAllRatings','order','data'));
    }


    
}
