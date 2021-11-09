<?php

namespace Tests\Feature;

use App\Models\PuzzleTeam;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PuzzleLeaderboardTest extends SiteTest
{
    use RefreshDatabase;

    public function test_puzzle_leaderboard_can_be_viewed(){
        Section::factory()->create(['title' => 'Puzzles']);
        $team = PuzzleTeam::factory()->create();

        // On homepage
        $response = $this->get('/');
        $response->assertSee($team->name);

        // On puzzle's section page
        $response = $this->get('/section/puzzles');
        $response->assertSee($team->name);
    }
}
