<?php

function keywords(){
    $keyword = 'Repair My Car';
    return $keyword;
}
function descriptions()
{
    $description = 'Repair My Car';
    return $description;
}

function modelYear($model_year_id)
{
    $modelYear = \App\Models\ModelYear::where('id',$model_year_id)->first();

    return $modelYear->model_year;
}

function getCompany($company_id)
{
    $company = \App\Models\Company::where('id',$company_id)->first();

    return ucfirst($company->company);
}

function getCountryByVendor($vendor_id)
{
    $vendor = \App\Models\Vendor::where('id',$vendor_id)->first();
    if($vendor){
        return ucfirst($vendor->country);
    }else{
        $user = \App\Models\User::where('id',$vendor_id)->first();
        return ucfirst($user->country);
    }
}

function getCityByVendor($vendor_id)
{
    $vendor = \App\Models\Vendor::where('id',$vendor_id)->first();
    if($vendor){
        return ucfirst($vendor->city);
    }else{
        $user = \App\Models\User::where('id',$vendor_id)->first();
        return ucfirst($user->city);
    }

}

function getModelByUserBid($user_bid_id)
{
    $user_bid = \App\Models\UserBid::where('id',$user_bid_id)->first();

    return ucfirst($user_bid->model);
}

function getCompanyByUserBid($vendor_id)
{
    $vendor = \App\Models\Vendor::where('id',$vendor_id)->first();

    return ucfirst($vendor->city);
}

function getUserNameById($user_id)
{
    $user = \App\Models\User::where('id',$user_id)->first();

    return ucfirst($user->name);
}


