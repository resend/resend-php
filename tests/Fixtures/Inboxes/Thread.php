<?php

function inboxThreadListItem(): array
{
    return [
        'id' => '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f',
        'subject' => 'Question about my invoice',
        'from' => 'Ada Lovelace <ada@example.org>',
        'to' => ['support@acme.com'],
        'cc' => [],
        'bcc' => [],
        'labels' => [
            [
                'id' => '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34',
                'name' => 'Billing',
                'color' => '#3B82F6',
            ],
        ],
        'email_count' => 2,
        'has_attachment' => false,
        'has_draft' => false,
        'read' => false,
        'received_at' => '2026-09-14T10:22:31.000Z',
        'folder' => 'inbox',
    ];
}

function inboxThreads(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [inboxThreadListItem()],
    ];
}

function inboxThreadSearchResults(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            array_merge(inboxThreadListItem(), [
                'matched_email_id' => '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d',
            ]),
        ],
    ];
}

function inboxThread(array $overrides = []): array
{
    return array_merge([
        'object' => 'inbox_thread',
        'id' => '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f',
        'subject' => 'Question about my invoice',
        'folder' => 'inbox',
        'labels' => [],
        'read' => false,
    ], $overrides);
}
