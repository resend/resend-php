<?php

function inboxDraft(array $overrides = []): array
{
    return array_merge([
        'object' => 'inbox_draft',
        'id' => 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a',
        'type' => 'standalone',
        'to' => ['ada@example.org'],
        'cc' => [],
        'bcc' => [],
        'subject' => 'Welcome to Acme',
        'html' => null,
        'text' => 'Thanks for signing up.',
        'thread_id' => null,
        'reply_to_email_id' => null,
        'email_id' => null,
        'attachments' => [
            [
                'id' => '5c1e8f2a-9b3d-4e6f-a7c8-0d1e2f3a4b5c',
                'filename' => 'notes.txt',
                'content_type' => 'text/plain',
                'size' => 5,
            ],
        ],
        'created_at' => '2026-09-14T10:22:31.000Z',
        'updated_at' => '2026-09-14T10:22:31.000Z',
    ], $overrides);
}

function inboxDrafts(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a',
                'type' => 'standalone',
                'to' => null,
                'cc' => [],
                'bcc' => [],
                'subject' => 'Welcome to Acme',
                'snippet' => 'Thanks for signing up.',
                'thread_id' => null,
                'reply_to_email_id' => null,
                'attachments' => [],
                'updated_at' => '2026-09-14T10:22:31.000Z',
            ],
        ],
    ];
}
