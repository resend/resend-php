<?php

function email(): array
{
    return [
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
        'message_id' => '<111-222-333@email.example.com>',
        'from' => 'onboarding@resend.dev',
        'to' => 'user@gmail.com',
        'created_at' => '2022-07-25 00:28:32.493138+00',
    ];
}

function emails(): array
{
    return [
        'data' => [
            [
                'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
                'message_id' => '<111-222-333@email.example.com>',
                'from' => 'onboarding@resend.dev',
                'to' => 'user@gmail.com',
                'created_at' => '2022-07-25 00:28:32.493138+00',
            ],
            [
                'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
                'message_id' => '<111-222-333@email.example.com>',
                'from' => 'onboarding@resend.dev',
                'to' => 'user@gmail.com',
                'created_at' => '2022-07-25 00:28:32.493138+00',
            ],
        ],
    ];
}

function sharedEmail(): array
{
    return [
        'object' => 'email',
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
        'url' => 'https://resend.com/share/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
    ];
}

function metrics(array $overrides = []): array
{
    return array_merge([
        'object' => 'metrics',
        'start_date' => '2026-07-01T00:00:00.000Z',
        'end_date' => '2026-07-08T00:00:00.000Z',
        'metrics' => ['delivered', 'opened'],
        'dimensions' => [],
        'granularity' => 'daily',
        'totals' => [
            'delivered' => 100,
            'opened' => 40,
        ],
    ], $overrides);
}

function batch(): array
{
    return [
        'data' => [
            [
                'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
            ],
            [
                'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
            ],
        ],
    ];
}
