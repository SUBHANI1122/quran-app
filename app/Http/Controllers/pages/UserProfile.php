<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfile extends Controller
{
  public function index()
  {
    return view('content.laravel-example.my-profile');
    // return view('content.pages.pages-profile-user');
  }

  public function security()
  {
    return view('content.laravel-example.security');
    // return view('content.pages.pages-profile-user');
  }
}
