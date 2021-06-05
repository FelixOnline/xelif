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

    public function test_issueless_article_always_published()
    {
        $article = Article::factory()->published(true)->create();
        $this->assertNull($article->issue);
        $this->assertNotEmpty($article->where('id', $article->id)->published()->get());
    }
}
