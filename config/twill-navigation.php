<?php

return [
    'issues' => [
        'title' => 'Issues',
        'module' => true,
    ],
    'articles' => [
        'title' => 'Articles',
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
    'articleUpload' => [
        'title' => 'Upload Article',
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
