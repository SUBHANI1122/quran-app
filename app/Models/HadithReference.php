<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HadithReference extends Model
{
    use HasFactory;

    protected $fillable = ['topic_hadiths_id', 'book_name', 'reference_number'];

    public function hadith()
    {
        return $this->belongsTo(TopicHadith::class);
    }
}
