<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleView;
use Mockery\MockInterface;

class ArticleViewTest extends SiteTest
{
    public function test_article_view_is_logged()
    {
        $article = Article::factory()->create();
        $this->partialMock(ArticleView::class, function (MockInterface $mock) use ($article) {
            $mock->shouldReceive('createViewRecord')->with($article->id);
        });
        $response = $this->get($article->link());
        $response->assertSuccessful();
    }
}
