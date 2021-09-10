<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Issue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class FeaturedTest extends SiteTest
{
    use RefreshDatabase;
    use WithFaker;

    public function test_article_can_be_featured_as_headline(){
        $issue = Issue::factory()->published(true)->create();
        $others = Article::factory()->published(true)->for($issue)->count(10)->create();
        $featured = Article::factory()->published(true)->for($issue)->hasBuckets(1)->create();

        $response = $this->get('/');
        $response->assertSeeInOrder([$featured->headline, $others[0]->headline]);
    }
}
