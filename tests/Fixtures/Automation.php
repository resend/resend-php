<?php

function automation(): array
{
    return [
        'object' => 'automation',
        'id' => 'c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd',
        'name' => 'Welcome series',
        'status' => 'enabled',
        'created_at' => '2025-10-01 12:00:00.000000+00',
        'updated_at' => '2025-10-01 12:00:00.000000+00',
        'steps' => [
            [
                'key' => 'trigger',
                'type' => 'trigger',
                'config' => ['event_name' => 'user.created'],
            ],
            [
                'key' => 'send_welcome',
                'type' => 'send_email',
                'config' => [
                    'template_id' => 'tpl_xxxxxxxxx',
                    'subject' => 'Welcome!',
                    'from' => 'Acme <hello@example.com>',
                ],
            ],
            [
                'key' => 'wait_2_days',
                'type' => 'delay',
                'config' => ['duration' => '2 days'],
            ],
            [
                'key' => 'send_getting_started',
                'type' => 'send_email',
                'config' => [
                    'template_id' => 'f6e86e54-0ab4-404d-8edc-d52ea8cf602e',
                    'subject' => 'Getting started',
                    'from' => 'Acme <hello@example.com>',
                ],
            ],
        ],
        'connections' => [
            [
                'from' => 'trigger',
                'to' => 'send_welcome',
                'type' => 'default',
            ],
            [
                'from' => 'send_welcome',
                'to' => 'wait_2_days',
                'type' => 'default',
            ],
            [
                'from' => 'wait_2_days',
                'to' => 'send_getting_started',
                'type' => 'default',
            ],
        ],
    ];
}

function automations(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'object' => 'automation',
                'id' => 'c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd',
                'name' => 'Welcome series',
                'status' => 'enabled',
                'created_at' => '2025-10-01 12:00:00.000000+00',
                'updated_at' => '2025-10-01 12:00:00.000000+00',
            ],
        ],
    ];
}
