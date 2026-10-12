<?php

use Resend\Collection;
use Resend\Email;
use Resend\Inboxes\Threads\Email as ThreadEmail;

it('can get a list of email resources for a thread', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/emails?limit=20&after=7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d', [], [], inboxThreadEmails());

    $result = $client->inboxes->threads->emails->list('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [
        'limit' => 20,
        'after' => '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d',
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(ThreadEmail::class)
        ->direction->toBe('inbound');
});

it('can get an email resource of a thread', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/emails/7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d', [], [], inboxThreadEmail());

    $result = $client->inboxes->threads->emails->get('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d');

    expect($result)->toBeInstanceOf(ThreadEmail::class)
        ->id->toBe('7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d')
        ->attachments->toHaveCount(1);
});

it('can reply to an email of a thread', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/emails/7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d/reply', [
        'text' => 'Thanks, we are on it.',
        'reply_all' => true,
        'attachments' => [
            [
                'filename' => 'notes.txt',
                'content' => 'aGVsbG8=',
            ],
        ],
    ], [], [
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
    ]);

    $result = $client->inboxes->threads->emails->reply('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d', [
        'text' => 'Thanks, we are on it.',
        'reply_all' => true,
        'attachments' => [
            [
                'filename' => 'notes.txt',
                'content' => 'aGVsbG8=',
            ],
        ],
    ]);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can forward an email of a thread', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f/emails/7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d/forward', [
        'to' => ['billing@acme.com'],
        'text' => 'Can you check this invoice?',
    ], [], [
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
    ]);

    $result = $client->inboxes->threads->emails->forward('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d', [
        'to' => ['billing@acme.com'],
        'text' => 'Can you check this invoice?',
    ]);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});
