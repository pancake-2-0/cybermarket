<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleSearchableTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_searchable_array_includes_category_name(): void
    {
        $category = Category::factory()->create(['name' => 'console']);
        $article = Article::factory()->create([
            'title' => 'PlayStation 5',
            'category_id' => $category->id,
        ]);

        $searchable = $article->toSearchableArray();

        $this->assertSame($category->id, $searchable['category_id']);
        $this->assertSame('console', $searchable['category_name']);
    }

    public function test_should_be_searchable_only_when_accepted(): void
    {
        $accepted = Article::factory()->create(['is_accepted' => true]);
        $this->assertTrue($accepted->shouldBeSearchable());

        $notAccepted = Article::factory()->create(['is_accepted' => null]);
        $this->assertFalse($notAccepted->shouldBeSearchable());

        $rejected = Article::factory()->create(['is_accepted' => false]);
        $this->assertFalse($rejected->shouldBeSearchable());
    }
}

