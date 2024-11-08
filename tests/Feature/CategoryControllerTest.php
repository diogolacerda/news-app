<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_categories(): void
    {
        Category::factory()->count(3)->create();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories');
    }

    public function test_index_filters_categories_by_search_term(): void
    {
        Category::factory()->count(3)->create();
        $category = Category::factory()->create([
            'name' => 'Test Category',
        ]);

        $response = $this->get(route('categories.index', [
                'search' => 'Test Category',
            ]));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories', function ($categories) use ($category) {
            return $categories->contains($category);
        });
    }

    public function test_create_displays_form(): void
    {
        $response = $this->get(route('categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.create');
    }

    public function test_store_saves_category(): void
    {
        $response = $this->post(route('categories.store'), [
                'name' => 'Test Category',
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);

        $response->assertRedirect(route('categories.index'));
    }

    public function test_store_fails_with_invalid_data(): void
    {
        $response = $this->post(route('categories.store'), [
                'name' => '',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_store_fails_with_duplicated_name(): void
    {
        Category::factory()->create([
            'name' => 'Test Category',
        ]);

        $response = $this->post(route('categories.store'), [
                'name' => 'Test Category',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_edit_displays_form(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('categories.edit', $category));

        $response->assertStatus(200);
        $response->assertViewIs('categories.edit');
        $response->assertViewHas('category', $category);
    }

    public function test_update_updates_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->put(route('categories.update', $category), [
                'name' => 'Updated Category',
            ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
        ]);

        $response->assertRedirect(route('categories.index'));
    }

    public function test_update_fails_with_invalid_data(): void
    {
        $category = Category::factory()->create();

        $response = $this->put(route('categories.update', $category), [
                'name' => '',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_update_fails_with_duplicated_name(): void
    {
        Category::factory()->create([
            'name' => 'Test Category',
        ]);

        $category = Category::factory()->create([
            'name' => 'Test Category2',
        ]);

        $response = $this->put(route('categories.update', $category), [
                'name' => 'Test Category',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('name');
    }

    public function test_destroy_deletes_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category));

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);

        $response->assertRedirect(route('categories.index'));
    }
}
