<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicUserProgress extends Model
{
    protected $fillable = ['user_id', 'topic_id', 'progress'];


    public function topic()
{
    return $this->belongsTo(Topic::class);
}
}
