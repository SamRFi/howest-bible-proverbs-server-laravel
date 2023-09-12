<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function insights()
    {
        return $this->hasMany(Insight::class);
    }

    public function translations()
    {
        return $this->hasMany(ChapterTranslation::class);
    }
}
