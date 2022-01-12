<?php

return [
    'issues' => [
        'title' => 'Issues',
        'module' => true,
    ],
    'sections' => [
        'title' => 'Sections',
        'module' => true,
    ],
    'writers' => [
        'title' => 'Writers',
        'module' => true,
    ],
    'puzzleTeams' => [
        'title' => 'Puzzle Leaderboard',
        'module' => true,
    ],
    'articleUpload' => [
        'title' => 'Upload From Word (Experimental)',
        'route' => 'admin.uploader',
    ],
    'featured' => [
        'title' => 'Featured',
        'route' => 'admin.featured.homepage',
        'can' => 'feature',
        'primary_navigation' => [
            'homepage' => [
                'title' => 'Homepage',
                'route' => 'admin.featured.homepage',
            ]
        ],
    ],
    'settings' => [
        'title' => 'Settings',
        'route' => 'admin.settings',
        'can' => 'administrate',
        'params' => ['section' => 'look-and-feel'],
        'primary-navigation' => [
            'look-and-feel' => [
                'title' => 'Look & Feel',
                'route' => 'admin.settings',
                'params' => ['section' => 'look-and-feel']
            ],
        ],
    ],
];
