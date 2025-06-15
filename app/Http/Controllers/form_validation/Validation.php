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
    return TopicResource::collection(Topic::with(['ayahs', 'hadiths'])->where('status', 'published')->get());
  }
  public function getTopicOfTheDayById($topic_id)
  {
    $topic = Topic::with(['ayahs', 'hadiths'])
      ->where('id', $topic_id)
      ->where('status', 'published')
      ->first();

    if (!$topic) {
      return response()->json([
        'success' => false,
        'message' => 'Topic not found or not published.',
      ], 404);
    }
    return response()->json([
      'success' => true,
      'topic' => new TopicResource($topic),
    ]);
  }

  public function destroy(Topic $topic)
  {
    $topic->delete();
    return response()->json(['success' => true]);
  }

  public function setTopicOfTheDay($id)
  {
    Topic::where('topic_of_the_day', true)->update(['topic_of_the_day' => false]);

    $topic = Topic::find($id);
    $topic->update(['topic_of_the_day' => true]);

    return response()->json(['success' => true]);
  }
}
