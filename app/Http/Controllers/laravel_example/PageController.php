<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surah;
use App\Models\Juz;
use App\Models\Ayah;

class PageController extends Controller
{
    public function index()
    {
        $surahs = Surah::orderBy('id')->get();
        $juzz = Juz::orderBy('number')->get();

        return view('website.index', compact('surahs', 'juzz'));
    }

    public function getAyahsBySurah($surahNumber)
    {
        $ayahs = Ayah::where('surah_number', $surahNumber)->orderBy('ayah_number')->get();

        return response()->json($ayahs);
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
