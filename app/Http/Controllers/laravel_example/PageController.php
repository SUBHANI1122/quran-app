<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('website.index');
    }

    public function aboutUs()
    {
        return view('website.about-us');
    }

    public function quran()
    {
        return view('website.quran');
    }

    public function contactUs()
    {
        return view('website.contact-us');
    }

    public function blogs()
    {
        return view('website.blogs');
    }

    public function quranBilAunwan()
    {
        return view('website.quran-bil-awunwan');
    }
}
