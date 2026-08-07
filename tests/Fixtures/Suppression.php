<?php

function suppression(): array
{
    return [
        'object' => 'suppression',
        'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
        'email' => 'steve.wozniak@example.com',
        'origin' => 'bounce',
        'source_id' => '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
        'created_at' => '2026-10-06 23:47:56.678+00',
    ];
}

function suppressions(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'object' => 'suppression',
                'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
                'email' => 'steve.wozniak@example.com',
                'origin' => 'manual',
                'source_id' => null,
                'created_at' => '2026-10-06 23:47:56.678+00',
            ],
            [
                'object' => 'suppression',
                'id' => '520784e2-887d-4c25-b53c-4ad46ad38100',
                'email' => 'susan.kare@example.com',
                'origin' => 'bounce',
                'source_id' => '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
                'created_at' => '2026-10-07 08:12:03.412+00',
            ],
        ],
    ];
}
