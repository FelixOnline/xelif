<?php

namespace App\Http\Controllers;

use App\Models\PuzzleTeam;

class PuzzleLeaderboardController extends Controller
{
    protected $settingsController;

    public function __construct(SettingsController $settings)
    {
        $this->settingsController = $settings;
    }

    public function show(){
        return view('layouts.leaderboard', coreData($this->settingsController) + [
            'teams' => PuzzleTeam::ordered()->get(),
        ]);
    }
}