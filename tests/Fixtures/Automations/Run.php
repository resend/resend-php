<?php

function automationRun(): array
{
    return [
        'object' => 'automation_run',
        'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
        'status' => 'completed',
        'trigger' => [
            'event_name' => 'user.created',
            'payload' => ['email' => 'jane@example.com'],
        ],
        'started_at' => '2025-10-01 12:00:00.000000+00',
        'completed_at' => '2025-10-01 12:05:00.000000+00',
        'created_at' => '2025-10-01 12:00:00.000000+00',
    ];
}

function automationRuns(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'object' => 'automation_run',
                'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
                'status' => 'completed',
                'trigger' => [
                    'event_name' => 'user.created',
                    'payload' => ['email' => 'jane@example.com'],
                ],
                'started_at' => '2025-10-01 12:00:00.000000+00',
                'completed_at' => '2025-10-01 12:05:00.000000+00',
                'created_at' => '2025-10-01 12:00:00.000000+00',
            ],
        ],
    ];
}
