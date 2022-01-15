<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;

class TopStoriesTest extends SiteTest
{
    use RefreshDatabase;

    public function test_article_is_trending(){
        $article = Article::factory()->create();
        $this->get($article->link());
        $response = $this->get('/');

        $response->assertSeeInOrder(["Currently Trending", $article->headline]);
    }

    public function test_deleted_article_is_not_trending(){
        $article = Article::factory()->create();
        $this->get($article->link());

        $response = $this->get('/');
        $response->assertSeeInOrder(["Currently Trending", $article->headline]);

        $article->delete();

        $response = $this->get('/');
        $response->assertDontSee($article->headline);
    }
}