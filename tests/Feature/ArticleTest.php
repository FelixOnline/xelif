<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_only_published_when_issue_is()
    {
        $article = Article::factory()->published(true)->forIssue([
            'published' => true
        ])->create();
        $this->assertNotEmpty($article->where('id', $article->id)->published()->get());

        $article = Article::factory()->published(true)->forIssue([
            'published' => false
        ])->create();
        $this->assertEmpty($article->where('id', $article->id)->published()->get());
    }
}
