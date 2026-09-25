<?php

function usage(): array
{
    return [
        'object' => 'usage',
        'emails' => [
            'daily' => [
                'used' => 258,
                'limit' => null,
                'sent' => 57,
                'received' => 201,
                'resets_at' => '2026-07-17T00:00:00.000Z',
            ],
            'monthly' => [
                'used' => 5422,
                'limit' => 10000,
                'sent' => 1000,
                'received' => 4442,
                'resets_at' => '2026-08-01T00:00:00.000Z',
            ],
        ],
        'contacts' => [
            'used' => 85000,
            'limit' => 150000,
        ],
        'segments' => [
            'used' => 2,
            'limit' => 3,
        ],
        'broadcasts' => [
            'used' => 100,
            'limit' => null,
        ],
        'ai_credits' => [
            'used' => 0,
            'limit' => 500,
            'next_increase_at' => '2026-07-18T09:00:00.000Z',
        ],
        'automation_runs' => [
            'used' => 0,
            'limit' => 1000,
            'resets_at' => '2026-08-01T00:00:00.000Z',
        ],
        'domains' => [
            'used' => 1,
            'limit' => 1000,
        ],
        'rate_limit' => [
            'limit' => 10,
            'duration' => '1000ms',
        ],
    ];
}
