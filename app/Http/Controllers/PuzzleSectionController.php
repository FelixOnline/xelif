<?php

namespace App\Http\Controllers;

use App\Models\PuzzleTeam;
use App\Models\Section;

class PuzzleSectionController extends Controller
{
    protected $settingsController;

    public function __construct(SettingsController $settings)
    {
        $this->settingsController = $settings;
    }

    public function show(){
        $section = Section::forSlug("puzzles")->firstOrFail();

        return view('layouts.leaderboard', coreData($this->settingsController) +[
            'section' => $section,
            'sections' => Section::current()->ordered()->get(),
            'teams' => PuzzleTeam::ordered()->get(),
        ]);
    }
}