<?php

function inboxThreadEmail(): array
{
    return [
        'id' => '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d',
        'direction' => 'inbound',
        'from' => 'Ada Lovelace <ada@example.org>',
        'to' => ['support@acme.com'],
        'cc' => [],
        'bcc' => [],
        'reply_to' => [],
        'subject' => 'Question about my invoice',
        'message_id' => '<CAF=abc123@mail.example.org>',
        'html' => '<p>Hi, I have a question about my invoice.</p>',
        'text' => 'Hi, I have a question about my invoice.',
        'attachments' => [
            [
                'id' => '2a0c9ce0-3112-4728-976e-47ddcd16a318',
                'filename' => 'invoice.pdf',
                'size' => 4096,
            ],
        ],
        'read' => false,
        'received_at' => '2026-09-14T10:22:31.000Z',
    ];
}

function inboxThreadEmails(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [inboxThreadEmail()],
    ];
}
