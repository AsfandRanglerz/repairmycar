<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Garage;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title = 'Admin Dashboard';
        $dateFrom = Carbon::now()->subDays(30);
        $dateTo = Carbon::now();
        //monthlyRevenue = PaymentTransactions::whereNotNull('created_at')->whereBetween('created_at', [$dateFrom, $dateTo])->sum('amount');
        $monthlyRevenue = 0;
        $monthlyAdmin = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->whereNotNull('created_at')->whereBetween('created_at', [$dateFrom, $dateTo])->count();
        //$monthlyOrder = packageSubscription::whereNotNull('created_at')->whereBetween('created_at', [$dateFrom, $dateTo])->count();
        $monthlyOrder = 0;

        $previousDateFrom = Carbon::now()->subDays(60);
        $previousDateTo = Carbon::now()->subDays(31);
        //$previousMonthlyRevenue = PaymentTransactions::whereNotNull('created_at')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('amount');
        $previousMonthlyRevenue = 0;
        $previousMonthlyAdmin = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->whereNotNull('created_at')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();
        $previousMonthlyOrder = Admin::whereNotNull('created_at')->whereBetween('created_at', [$previousDateFrom, $previousDateTo])->count();

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

        // Admin  //

        $customer=User::where('type','user')->get();
        $vendor=Vendor::where('type','vendor')->get();
        $garage=Garage::all();
        $company=User::where('type','company')->get();
        return view('admin.index', compact('customer','vendor','garage','company','page_title', 'monthlyRevenue', 'previousMonthlyRevenue', 'monthlyAdmin', 'previousMonthlyAdmin', 'monthlyOrder', 'previousMonthlyOrder'));
    }
}
