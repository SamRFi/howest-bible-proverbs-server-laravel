<?php

namespace App\Services;

use App\Models\Chapter;
use App\Models\ChapterTranslation;

class BibleService extends Service
{
    public function __construct(Chapter $chapter)
    {
        parent::__construct($chapter);
    }

    public function getChapter($chapter_number, string $language_code)
    {
        $chapter = Chapter::where('number', $chapter_number)->first();

        if (!$chapter) {
            return null;
        }

        $chapterTranslation = ChapterTranslation::where('chapter_id', $chapter->id)
            ->where('language_code', $language_code)
            ->first();


        return $chapterTranslation;
    }
}
