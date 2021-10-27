<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Section;
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

    public function test_about_article_view_is_not_logged()
    {
        $article = Article::factory(['section_id' => Section::factory(['title' => 'About'])])->create();
        $this->partialMock(ArticleView::class, function (MockInterface $mock) use ($article) {
            $mock->shouldNotReceive('createViewRecord')->with($article->id);
        });
    }

}
