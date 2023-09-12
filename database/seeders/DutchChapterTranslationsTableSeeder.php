<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChapterTranslation;

class DutchChapterTranslationsTableSeeder extends Seeder
{

    public function run()
    {
        $numberOfChapters = 31;
        $languageCode = 'nl';
        $translationVersion = 'SV';

        for ($i = 1; $i <= $numberOfChapters; $i++) {
            $chapterContent = file_get_contents(database_path("seeders/nl_sv_chapter_contents/chapter{$i}.txt"));

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
