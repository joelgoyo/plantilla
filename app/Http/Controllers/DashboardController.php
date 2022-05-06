<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inversion;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
  public function index()
  {
    $pageConfigs = ['pageHeader' => false];

    $user = Auth::user();

    if($user->admin == 1){
      $inversion = Inversion::where('user_id', Auth::id())->where('status', 1)->orderBy('invested', 'desc')->first();
      return view('/dashboard/admin', ['pageConfigs' => $pageConfigs], compact('user','inversion'));
    }else{
      $inversion = Inversion::where('user_id', Auth::id())->where('status', 1)->orderBy('invested', 'desc')->first();
      return view('/dashboard/user', ['pageConfigs' => $pageConfigs],compact('inversion'));
    }

  }

  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];
  
    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }
}
