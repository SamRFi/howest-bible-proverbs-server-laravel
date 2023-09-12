<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    public function run()
    {
        $numberOfChapters = 31;

        for ($i = 1; $i <= $numberOfChapters; $i++) {
            Chapter::firstOrCreate([
                'number' => $i
            ]);
        }
    }
}
