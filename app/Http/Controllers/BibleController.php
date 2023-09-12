<?php

namespace App\Http\Controllers;

use App\Services\BibleService;
use Illuminate\Http\Request;

class BibleController extends Controller
{
    protected $bibleService;

    public function __construct(BibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    public function getChapter(Request $request, $chapter_number)
    {

        $language_code = $request->query('language', 'default_language_code');

        $chapterTranslation = $this->bibleService->getChapter($chapter_number, $language_code);

        if (!$chapterTranslation) {
            return response()->json(['message' => 'Chapter not found'], 404);
        }

        return response()->json($chapterTranslation);
    }
}
