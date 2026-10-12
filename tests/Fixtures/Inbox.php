<?php

function inbox(): array
{
    return [
        'object' => 'inbox',
        'id' => 'b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c',
        'name' => 'Support',
        'email_address' => 'support@acme.com',
        'domain_id' => '4a2c8e6f-1b3d-4e5f-8a7b-9c0d1e2f3a4b',
        'receiving_address' => null,
        'from_name' => 'Acme Support',
        'unread' => 3,
        'drafts' => 1,
        'last_received' => '2026-09-14T10:22:31.000Z',
        'created_at' => '2026-09-01T08:00:00.000Z',
    ];
}

function inboxes(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c',
                'name' => 'Support',
                'email_address' => 'support@acme.com',
                'from_name' => null,
                'unread' => 3,
                'last_received' => null,
            ],
        ],
    ];
}
