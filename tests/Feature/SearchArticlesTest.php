<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_query_redirects_to_index(): void
    {
        $this->get(route('article.search', ['query' => '']))
            ->assertRedirect(route('article.index'));
    }

    public function test_search_returns_results_page(): void
    {
        $article = Article::factory()->create(['title' => 'Nintendo Switch']);

        $this->get(route('article.search', ['query' => $article->title]))
            ->assertOk()
            ->assertSeeText('Nintendo Switch');
    }
}

