<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'alternative_name', 'description', 'ayah_count', 'hadith_count', 'status', 'topic_of_the_day'];

    public function ayahs()
    {
        return $this->hasMany(TopicAyah::class);
    }

    public function hadiths()
    {
        return $this->hasMany(TopicHadith::class);
    }
}
