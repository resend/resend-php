<?php

function event(): array
{
    return [
        'object' => 'event',
        'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
        'name' => 'user.created',
        'schema' => [
            'plan' => 'string',
        ],
        'created_at' => '2025-10-01T12:00:00.000Z',
        'updated_at' => '2025-10-01T12:00:00.000Z',
    ];
}

function sentEvent(): array
{
    return [
        'object' => 'event',
        'event' => 'user.created',
    ];
}

function events(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'object' => 'event',
                'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
                'name' => 'user.created',
                'schema' => [
                    'plan' => 'string',
                ],
                'created_at' => '2025-10-01T12:00:00.000Z',
                'updated_at' => '2025-10-01T12:00:00.000Z',
            ],
        ],
    ];
}
