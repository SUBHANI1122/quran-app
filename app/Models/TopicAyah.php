<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicAyah extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'ayah_id', 'description'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function ayah()
    {
        return $this->belongsTo(Ayah::class);
    }
}
