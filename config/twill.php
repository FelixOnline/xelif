<?php

return [
    'admin_middleware_group' => 'admin',
    'block_editor' => [
        'blocks' => [
            'text' => [
                'title' => 'Body text',
                'icon' => 'text',
                'component' => 'a17-block-text',
            ],
            'quotation' => [
                'title' => 'Quote',
                'icon' => 'text',
                'component' => 'a17-block-quotation',
            ],
            'sidebar' => [
                'title' => 'Sidebar',
                'icon' => 'text',
                'component' => 'a17-block-sidebar',
            ],
            'review' => [
                'title' => 'Theatre Review',
                'icon' => 'star-feature',
                'component' => 'a17-block-review',
            ],
            'book-review' => [
                'title' => 'Book Review',
                'icon' => 'star-feature',
                'component' => 'a17-block-book-review',
            ],
            'film-review' => [
                'title' => 'Film Review',
                'icon' => 'star-feature',
                'component' => 'a17-block-film-review',
            ],
            'image' => [
                'title' => 'Image',
                'icon' => 'image',
                'component' => 'a17-block-image',
            ]
        ],
        'block_views_path' => 'blocks',
        'block_single_layout' => 'admin/block-preview',
        'crops' => [
            // This controls the crop options of an "Image" block
            'image' => [
                'flexible' => [
                    [
                        'name' => 'free',
                        'ratio' => 0,
                    ],
                ],
            ],
        ],
    ],
    'buckets' => [
        'homepage' => [
            'name' => 'Home',
            'buckets' => [
                'featured' => [
                    'name' => 'Featured',
                    'bucketables' => [
                        [
                            'module' => 'articles',
                            'name' => 'Articles',
                            'scopes' => ['published' => true],
                            'orders' => ['created_at' => 'desc'],
                            'searchField' => '%headline',
                        ],
                    ],
                    'max_items' => 1,
                ],
            ],
        ],
    ],
    'bucketsRoutes' => [
        'homepage' => 'featured',
    ],
    'frontend' => [
        'views_path' => 'layouts'
    ],
    'media_library' => [
        'extra_metadatas_fields' => [
            ['name' => 'credit', 'label' => 'Credit'],
        ]
    ],
];
