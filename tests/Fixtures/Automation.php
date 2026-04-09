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
                'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
                'type' => 'trigger',
                'config' => ['event_name' => 'user.created'],
            ],
            [
                'id' => 'b2c3d4e5-f6a7-8901-bcde-f12345678901',
                'type' => 'send_email',
                'config' => [
                    'template_id' => 'tpl_xxxxxxxxx',
                    'subject' => 'Welcome!',
                    'from' => 'Acme <hello@example.com>',
                ],
            ],
            [
                'id' => 'c3d4e5f6-a7b8-9012-cdef-123456789012',
                'type' => 'delay',
                'config' => ['seconds' => 172800],
            ],
            [
                'id' => 'd4e5f6a7-b8c9-0123-def1-234567890123',
                'type' => 'send_email',
                'config' => [
                    'template_id' => 'f6e86e54-0ab4-404d-8edc-d52ea8cf602e',
                    'subject' => 'Getting started',
                    'from' => 'Acme <hello@example.com>',
                ],
            ],
        ],
        'edges' => [
            [
                'id' => 'e5f6a7b8-c9d0-1234-ef12-345678901234',
                'from' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
                'to' => 'b2c3d4e5-f6a7-8901-bcde-f12345678901',
                'edge_type' => 'default',
            ],
            [
                'id' => 'f6a7b8c9-d0e1-2345-f123-456789012345',
                'from' => 'b2c3d4e5-f6a7-8901-bcde-f12345678901',
                'to' => 'c3d4e5f6-a7b8-9012-cdef-123456789012',
                'edge_type' => 'default',
            ],
            [
                'id' => 'a7b8c9d0-e1f2-3456-0123-567890123456',
                'from' => 'c3d4e5f6-a7b8-9012-cdef-123456789012',
                'to' => 'd4e5f6a7-b8c9-0123-def1-234567890123',
                'edge_type' => 'default',
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
