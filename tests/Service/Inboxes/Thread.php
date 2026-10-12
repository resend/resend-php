<?php

use Resend\Collection;
use Resend\Inboxes\Thread;

it('can get a list of thread resources for an inbox', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads', [], [], inboxThreads());

    $result = $client->inboxes->threads->list('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');

    expect($result)->toBeInstanceOf(Collection::class)
        ->has_more->toBeFalse()
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(Thread::class)
        ->folder->toBe('inbox')
        ->message_count->toBe(2);
});

it('sends thread list filters as comma-separated values and literal booleans', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads?folders=inbox%2Csent&labels=7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34&read=false&limit=5&before=0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [], [], inboxThreads());

    $result = $client->inboxes->threads->list('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'folders' => ['inbox', 'sent'],
        'labels' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
        'read' => false,
        'limit' => 5,
        'before' => '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f',
        'query' => 'ignored',
    ]);

    expect($result)->toBeInstanceOf(Collection::class);
});

it('can search the threads of an inbox', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/search?query=invoice+%22due+date%22&from=ada%40example.org%2Cgrace&has_attachment=true&start_date=2026-09-01&end_date=2026-09-30&folders=inbox&read=true&limit=10', [], [], inboxThreadSearchResults());

    $result = $client->inboxes->threads->search('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'query' => 'invoice "due date"',
        'from' => ['ada@example.org', 'grace'],
        'has_attachment' => true,
        'start_date' => '2026-09-01',
        'end_date' => '2026-09-30',
        'folders' => ['inbox'],
        'read' => true,
        'limit' => 10,
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->and($result->data[0])->toBeInstanceOf(Thread::class)
        ->matched_email_id->toBe('7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d')
        ->highlights->toBe(['subject' => ['Question about my **invoice**']]);
});

it('can get a thread resource', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [], [], inboxThread());

    $result = $client->inboxes->threads->get('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f');

    expect($result)->toBeInstanceOf(Thread::class)
        ->object->toBe('inbox_thread')
        ->read->toBeFalse()
        ->message_count->toBeNull();
});

it('can update a thread resource', function () {
    $client = mockClient('PATCH', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [
        'read' => true,
        'folder' => 'archive',
        'add_label_ids' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
        'remove_label_ids' => ['2b6d0f4e-8a1c-4e3b-9d57-1c0e8a6f4b21'],
    ], [], inboxThread([
        'folder' => 'archive',
        'read' => true,
        'labels' => [
            [
                'id' => '7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34',
                'name' => 'Billing',
                'color' => '#3B82F6',
            ],
        ],
    ]));

    $result = $client->inboxes->threads->update('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [
        'read' => true,
        'folder' => 'archive',
        'add_label_ids' => ['7f9c1d2e-4a6b-4c3d-8e15-9b0a7c6d5e34'],
        'remove_label_ids' => ['2b6d0f4e-8a1c-4e3b-9d57-1c0e8a6f4b21'],
    ]);

    expect($result)->toBeInstanceOf(Thread::class)
        ->folder->toBe('archive')
        ->read->toBeTrue()
        ->labels->toHaveCount(1);
});

it('can remove a thread resource', function () {
    $client = mockClient('DELETE', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/threads/0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f', [], [], [
        'object' => 'inbox_thread',
        'id' => '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f',
        'deleted' => true,
    ]);

    $result = $client->inboxes->threads->remove('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f');

    expect($result)->toBeInstanceOf(Thread::class)
        ->deleted->toBeTrue();
});
