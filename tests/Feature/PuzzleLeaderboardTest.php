<?php

namespace Tests\Feature;

use App\Models\PuzzleTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PuzzleLeaderboardTest extends SiteTest
{
    use RefreshDatabase;

    public function test_puzzle_leaderboard_can_be_viewed(){
        $team = PuzzleTeam::factory()->create();

        $response = $this->get('/puzzles');
        $response->assertSee($team->name);
    }
}
