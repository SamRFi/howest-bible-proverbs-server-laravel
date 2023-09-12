<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\ChapterTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnglishChapterTranslationsTableSeeder extends Seeder
{
    public function run()
    {
        $numberOfChapters = 31;
        $languageCode = 'en';
        $translationVersion = 'KJV';

        for ($i = 1; $i <= $numberOfChapters; $i++) {
            $chapterContent = file_get_contents(database_path("seeders/en_kjv_chapter_contents/chapter{$i}.txt"));

            ChapterTranslation::firstOrCreate(
                [
                    'chapter_id' => $i,
                    'language_code' => $languageCode,
                    'translation_version' => $translationVersion,
                ],
                [
                    'content' => $chapterContent,
                ]
            );
        }
    }


}
