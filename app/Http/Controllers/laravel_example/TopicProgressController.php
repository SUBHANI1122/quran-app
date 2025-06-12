<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use App\Models\TopicUserProgress;
use Illuminate\Http\Request;

class TopicProgressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'topics' => 'required|array',
            'topics.*.topic_id' => 'required|exists:topics,id',
            'topics.*.progress' => 'required|integer|min:0|max:100',
        ]);

        foreach ($validated['topics'] as $topic) {
            TopicUserProgress::updateOrCreate(
                [
                    'user_id' => $validated['user_id'],
                    'topic_id' => $topic['topic_id'],
                ],
                [
                    'progress' => $topic['progress'],
                ]
            );
        }

        return response()->json(['message' => 'Progress saved successfully.']);
    }

    public function getUserProgress($user_id)
    {
        $progress = TopicUserProgress::where('user_id', $user_id)
            ->with('topic:id,name')
            ->get()
            ->map(function ($item) {
                return [
                    'topic_id' => $item->topic_id,
                    'topic_title' => $item->topic->name ?? '',
                    'progress' => $item->progress
                ];
            });

        return response()->json([
            'user_id' => $user_id,
            'progress' => $progress
        ]);
    }
}
