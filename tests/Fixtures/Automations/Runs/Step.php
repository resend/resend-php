<?php

function automationRunStep(): array
{
    return [
        'object' => 'automation_run_step',
        'id' => 's1a2b3c4-d5e6-7890-abcd-ef1234567890',
        'step_id' => 'd1e2f3a4-b5c6-7890-abcd-ef1234567890',
        'type' => 'trigger',
        'config' => ['event_name' => 'user.created'],
        'status' => 'completed',
        'started_at' => '2025-10-01 12:00:00.000000+00',
        'completed_at' => '2025-10-01 12:01:00.000000+00',
        'created_at' => '2025-10-01 12:00:00.000000+00',
    ];
}

function automationRunSteps(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'object' => 'automation_run_step',
                'id' => 's1a2b3c4-d5e6-7890-abcd-ef1234567890',
                'step_id' => 'd1e2f3a4-b5c6-7890-abcd-ef1234567890',
                'type' => 'trigger',
                'config' => ['event_name' => 'user.created'],
                'status' => 'completed',
                'started_at' => '2025-10-01 12:00:00.000000+00',
                'completed_at' => '2025-10-01 12:01:00.000000+00',
                'created_at' => '2025-10-01 12:00:00.000000+00',
            ],
        ],
    ];
}
