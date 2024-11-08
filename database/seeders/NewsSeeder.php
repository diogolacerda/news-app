<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Category;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory()->count(5)->create();

        News::factory()->count(50)->create()->each(function ($news) use ($categories) {
            $news->category()->associate($categories->random());
            $news->save();
        });
    }
}
