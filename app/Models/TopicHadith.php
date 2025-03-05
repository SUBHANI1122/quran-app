<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicHadith extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'hadith_text_arabic', 'hadith_text_urdu','hadith_text_english','description'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
