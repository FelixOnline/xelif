<?php

return [
    'admin_middleware_group' => 'admin',
    'block_editor' => [
        'blocks' => [
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
                'title' => 'Review',
                'icon' => 'star-feature',
                'component' => 'a17-block-review',
            ],
        ],
        'block_views_path' => 'blocks',
        'block_single_layout' => 'admin/block-preview'
    ],
    'buckets' => [
        'homepage' => [
            'name' => 'Home',
            'buckets' => [
                'top_stories' => [
                    'name' => 'Top Stories',
                    'bucketables' => [
                        [
                            'module' => 'articles',
                            'name' => 'Articles',
                            'scopes' => ['published' => true],
                            'searchField' => '%headline',
                        ],
                    ],
                    'max_items' => 5,
                ],
            ],
        ],
    ],
    'bucketsRoutes' => [
        'homepage' => 'top-stories',
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
