<?php

use Resend\Collection;
use Resend\Email;
use Resend\Inboxes\Draft;

it('can get a list of draft resources for an inbox', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts?limit=10', [], [], inboxDrafts());

    $result = $client->inboxes->drafts->list('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'limit' => 10,
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(Draft::class)
        ->snippet->toBe('Thanks for signing up.')
        ->to->toBeNull();
});

it('can create a draft resource that starts a new thread', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts', [
        'to' => ['ada@example.org'],
        'subject' => 'Welcome to Acme',
        'text' => 'Thanks for signing up.',
    ], [], [
        'object' => 'inbox_draft',
        'id' => 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a',
    ]);

    $result = $client->inboxes->drafts->create('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'to' => ['ada@example.org'],
        'subject' => 'Welcome to Acme',
        'text' => 'Thanks for signing up.',
    ]);

    expect($result)->toBeInstanceOf(Draft::class)
        ->id->toBe('d1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a');
});

it('can create a reply draft resource in an existing thread', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts', [
        'text' => 'Following up on your invoice.',
        'thread_id' => '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f',
        'reply_to_email_id' => '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d',
    ], [], [
        'object' => 'inbox_draft',
        'id' => 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a',
    ]);

    $result = $client->inboxes->drafts->create('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'text' => 'Following up on your invoice.',
        'thread_id' => '0f1e2d3c-4b5a-4968-8776-5a4b3c2d1e0f',
        'reply_to_email_id' => '7a8b9c0d-1e2f-4a3b-8c4d-5e6f7a8b9c0d',
    ]);

    expect($result)->toBeInstanceOf(Draft::class)
        ->id->toBe('d1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a');
});

it('can get a draft resource', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts/d1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a', [], [], inboxDraft());

    $result = $client->inboxes->drafts->get('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a');

    expect($result)->toBeInstanceOf(Draft::class)
        ->type->toBe('standalone')
        ->email_id->toBeNull();
});

it('can update a draft resource', function () {
    $client = mockClient('PATCH', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts/d1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a', [
        'subject' => 'Welcome aboard',
        'cc' => null,
    ], [], inboxDraft(['subject' => 'Welcome aboard']));

    $result = $client->inboxes->drafts->update('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a', [
        'subject' => 'Welcome aboard',
        'cc' => null,
    ]);

    expect($result)->toBeInstanceOf(Draft::class)
        ->subject->toBe('Welcome aboard');
});

it('can remove a draft resource', function () {
    $client = mockClient('DELETE', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts/d1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a', [], [], [
        'object' => 'inbox_draft',
        'id' => 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a',
        'deleted' => true,
    ]);

    $result = $client->inboxes->drafts->remove('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a');

    expect($result)->toBeInstanceOf(Draft::class)
        ->deleted->toBeTrue();
});

it('can send a draft resource', function () {
    $client = mockClient('POST', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/drafts/d1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a/send', [], [], [
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
    ]);

    $result = $client->inboxes->drafts->send('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', 'd1e2f3a4-b5c6-4d7e-8f9a-0b1c2d3e4f5a');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});
