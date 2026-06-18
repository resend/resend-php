<?php

function contactImport(): array
{
    return [
        'id' => '479e3145-dd38-476b-932c-529ceb705947',
        'object' => 'contact_import',
        'status' => 'completed',
        'created_at' => '2026-05-15 18:32:37.823+00',
        'completed_at' => '2026-05-15 18:33:42.916+00',
        'counts' => [
            'total' => 1200,
            'created' => 800,
            'updated' => 300,
            'skipped' => 75,
            'failed' => 25,
        ],
    ];
}

function contactImports(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => '479e3145-dd38-476b-932c-529ceb705947',
                'object' => 'contact_import',
                'status' => 'completed',
                'created_at' => '2026-05-15 18:32:37.823+00',
                'completed_at' => '2026-05-15 18:33:42.916+00',
                'counts' => [
                    'total' => 1200,
                    'created' => 800,
                    'updated' => 300,
                    'skipped' => 75,
                    'failed' => 25,
                ],
            ],
        ],
    ];
}
