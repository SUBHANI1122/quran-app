<?php

namespace App\Http\Controllers\form_wizard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Numbered extends Controller
{
  public function index()
  {
    return view('content.laravel-example.topics.form');
  }
}
