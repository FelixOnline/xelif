<?php

namespace Tests\Feature;

use App\Http\Controllers\SettingsController;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $newsSection = null;
    protected $aboutSection = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock(SettingsController::class, function (MockInterface $mock) {
            $mock->shouldReceive('lookAndFeel')->andReturn([
                'title-text' => $this->faker->text(20),
                'meta-description' => $this->faker->text(100),
                'meta-theme-colour' => $this->faker->hexColor,
                'issn' => $this->faker->text(9),
                'tagline' => $this->faker->text(100),
                'motto' => $this->faker->text(30),
                'masthead-title' => $this->faker->text(20),
                'minihead-title' => $this->faker->text(20),
                'address' => $this->faker->address,
                'postcode' => $this->faker->postcode,
                'telephone' => $this->faker->phoneNumber,
                'copyright' => $this->faker->text(30),
                'maxAttention' => 40,
                'attentionPunctuationSplit' => '?!,.;:"',
                'instagram' => 'felix_imperial',
                'twitter' => 'feliximperial',
                'facebook' => 'FelixImperial',
                'email' => 'felix@ic.ac.uk',
                'disable-menu-underline' => false,
                'one-index-featured' => false,
                'full-nav-cols' => 6
            ]);
        });

        $this->newsSection = Section::factory()->create(['title' => 'News']);
        $this->aboutSection = Section::factory()->create(['title' => 'About']);
    }

}