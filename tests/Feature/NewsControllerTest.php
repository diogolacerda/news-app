<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\News;
use App\Models\Category;


class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_display_news(): void
    {
        News::factory()->count(3)->create();
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertViewIs('news.index');
        $response->assertViewHas('news');
    }

    public function test_index_filters_news_by_search_term(): void
    {
        News::factory()->count(3)->create();
        $news = News::factory()->create([
            'title' => 'Test News',
        ]);

        $response = $this->get(route('news.index', [
                'search' => 'Test News',
            ]));

        $response->assertStatus(200);
        $response->assertViewIs('news.index');
        $response->assertViewHas('news', function ($newsCollection) use ($news) {
            return $newsCollection->contains($news);
        });
    }

    public function test_index_filters_news_by_category(): void
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $newsInCategory1 = News::factory()->count(3)->create([
            'category_id' => $category1->id
        ]);
        $newsInCategory2 = News::factory()->count(3)->create([
            'category_id' => $category2->id
        ]);

        $response = $this->get(route('news.index', [
                'category_id' => $category1->id
            ]));

        $response->assertStatus(200);
        $response->assertViewIs('news.index');

        foreach ($newsInCategory1 as $news) {
            $response->assertSee($news->title);
        }

        foreach ($newsInCategory2 as $news) {
            $response->assertDontSee($news->title);
        }
    }

    public function test_create_displays_form(): void
    {
        $response = $this->get(route('news.create'));

        $response->assertStatus(200);
        $response->assertViewIs('news.create');
        $response->assertViewHas('categories');
    }

    public function test_store_saves_news_(): void
    {
        Category::factory()->create();
        $news_data = [
            'title' => 'Test News',
            'content' => 'Test Content',
            'category_id' => Category::first()->id,
        ];
        $response = $this->post(route('news.store'), $news_data);

        $response->assertRedirect(route('news.index'));

        $this->assertDatabaseHas('news', $news_data);
    }

    public function test_store_fails_with_invalid_data(): void
    {
        $response = $this->post(route('news.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'title',
            'content',
            'category_id'
        ]);
        $this->assertDatabaseCount('news', 0);
    }

    public function test_store_fails_with_invalid_category_id(): void
    {
        $response = $this->post(route('news.store'), [
                'title' => 'Test News',
                'content' => 'Test Content',
                'category_id' => 0,
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('category_id');
        $this->assertDatabaseCount('news', 0);
    }

    public function test_edit_displays_form(): void
    {
        $news = News::factory()->create();
        $response = $this->get(route('news.edit', $news));

        $response->assertStatus(200);
        $response->assertViewIs('news.edit');
        $response->assertViewHas('news', $news);
        $response->assertViewHas('categories');

    }

    public function test_update_updates_news(): void
    {
        $news = News::factory()->create();
        $news_data = [
            'title' => 'Updated News',
            'content' => 'Updated Content',
            'category_id' => Category::first()->id,
        ];
        $response = $this->put(route('news.update', $news), $news_data);

        $this->assertDatabaseHas('news', $news_data);
        $response->assertRedirect(route('news.index'));
    }

    public function test_update_fails_with_invalid_data(): void
    {
        $news = News::factory()->create();
        $response = $this->put(route('news.update', $news), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'title',
            'content',
            'category_id'
        ]);
    }

    public function test_update_fails_with_invalid_category_id(): void
    {
        $news = News::factory()->create();
        $response = $this->put(route('news.update', $news), [
                'title' => 'Updated News',
                'content' => 'Updated Content',
                'category_id' => 0,
            ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('category_id');
    }

    public function test_destroy_deletes_news(): void
    {
        $news = News::factory()->create();
        $response = $this->delete(route('news.destroy', $news));

        $this->assertDatabaseMissing('news', [
            'id' => $news->id,
        ]);
        $response->assertRedirect(route('news.index'));
    }
}
