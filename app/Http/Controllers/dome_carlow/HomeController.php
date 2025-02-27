<?php

namespace App\Http\Controllers\dome_carlow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('dome_carlow.index');
    }
    public function dashboard(){
      // return view('dome_carlow.main');
      return view('content.dashboard.dashboards-analytics');

    }
    public function date_time(){
        return view('dome_carlow.date_time');
    }
    public function personal_info(){
      return view('dome_carlow.personal_info');
    }
    public function payment(){
      return view('dome_carlow.payment');
    }
}
