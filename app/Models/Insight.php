<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;

class Insight extends Model
{
    protected $fillable = [
        'user_id',
        'chapter_id',
        'verse_number',
        'content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

}
