<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Issue;

class FeaturedTest extends SiteTest
{
    public function test_article_can_be_featured_as_headline(){
        $issue = Issue::factory()->published(true)->create();
        $others = Article::factory()->published(true)->for($issue)->for($this->newsSection)->count(10)->create();
        $featured = Article::factory()->published(true)->for($issue)->hasBuckets(1)->create();

        $response = $this->get('/');
        $response->assertSeeInOrder([$featured->headline, $others[0]->headline]);
    }
}
