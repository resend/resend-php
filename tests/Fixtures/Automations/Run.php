<?php

function automationRun(): array
{
    return [
        'object' => 'automation_run',
        'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
        'status' => 'completed',
        'started_at' => '2025-10-01 12:00:00.000000+00',
        'completed_at' => '2025-10-01 12:05:00.000000+00',
        'created_at' => '2025-10-01 12:00:00.000000+00',
        'steps' => [
            [
                'key' => 'trigger',
                'type' => 'trigger',
                'status' => 'completed',
                'started_at' => '2025-10-01 12:00:00.000000+00',
                'completed_at' => '2025-10-01 12:00:01.000000+00',
                'output' => null,
                'error' => null,
                'created_at' => '2025-10-01 12:00:00.000000+00',
            ],
            [
                'key' => 'send_welcome',
                'type' => 'send_email',
                'status' => 'completed',
                'started_at' => '2025-10-01 12:00:01.000000+00',
                'completed_at' => '2025-10-01 12:00:02.000000+00',
                'output' => null,
                'error' => null,
                'created_at' => '2025-10-01 12:00:01.000000+00',
            ],
        ],
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
                'started_at' => '2025-10-01 12:00:00.000000+00',
                'completed_at' => '2025-10-01 12:05:00.000000+00',
                'created_at' => '2025-10-01 12:00:00.000000+00',
            ],
        ],
    ];
}
