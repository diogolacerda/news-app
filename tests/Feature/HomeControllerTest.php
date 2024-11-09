<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Cache;


class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_displays_news_list(): void
    {
        $category = Category::factory()->create();

        $news = News::factory()->count(3)->create([
            'category_id' => $category->id
        ]);

        $response = $this->get(route('home.index'));

        $response->assertStatus(200);
        $response->assertViewIs('home.index');

        foreach ($news as $newsItem) {
            $response->assertSee($newsItem->title);
            $response->assertSee(Str::limit($newsItem->content, 100));
            $response->assertSee($category->name);
            $response->assertSee('Acessar');
        }
    }

    public function test_home_filters_news_by_search_term(): void
    {
        News::factory()->count(3)->create();
        $news = News::factory()->create(
            ['title' => 'Test News']
        );
        $other_news = News::factory()->create(
            ['title' => 'Other thing']
        );

        $response = $this->get(route('home.index', [
            'search' => 'Test News',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('home.index');
        $response->assertSee($news->title);
        $response->assertdontSee($other_news->title);
    }

    public function test_home_filters_news_by_category(): void
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $newsInCategory1 = News::factory()->count(3)->create([
            'category_id' => $category1->id
        ]);
        $newsInCategory2 = News::factory()->count(3)->create([
            'category_id' => $category2->id
        ]);

        $response = $this->get(route('home.index', [
            'category_id' => $category1->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('home.index');
        foreach ($newsInCategory1 as $newsItem) {
            $response->assertSee($newsItem->title);
        }
        foreach ($newsInCategory2 as $newsItem) {
            $response->assertDontSee($newsItem->title);
        }
    }

    public function test_show_displays_news_details(): void
    {
        $news = News::factory()->create();

        $response = $this->get(route('home.show', $news));

        $response->assertStatus(200);
        $response->assertViewIs('home.show');
        $response->assertSee($news->title);
        $response->assertSee($news->category->name);
        $response->assertSee($news->content);
    }
}
