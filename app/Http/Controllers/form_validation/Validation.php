<?php

namespace App\Http\Controllers\form_validation;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class Validation extends Controller
{
  public function index()
  {
    $topics = Topic::withCount(['ayahs', 'hadiths'])->get();
    return view('content.laravel-example.topics.index', ['topics' => $topics]);
  }

  public function create()
  {
    return view('content.laravel-example.topics.form');
  }

  public function topicsApi()
  {
    return TopicResource::collection(Topic::with(['ayahs', 'hadiths'])->get());
  }
}
