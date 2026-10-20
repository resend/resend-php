<?php

use Resend\Inboxes\Agent;

it('can get the agent settings of an inbox', function () {
    $client = mockClient('GET', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/agent', [], [], inboxAgent());

    $result = $client->inboxes->agent->get('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c');

    expect($result)->toBeInstanceOf(Agent::class)
        ->object->toBe('inbox_agent')
        ->tone->toBe('concise_casual')
        ->actions->toBe(['draft_reply', 'archive', 'move_to_trash']);
});

it('can get the agent settings of an inbox by its email address', function () {
    $client = mockClient('GET', 'inboxes/support%40acme.com/agent', [], [], inboxAgent());

    $result = $client->inboxes->agent->get('support@acme.com');

    expect($result)->toBeInstanceOf(Agent::class);
});

it('can update the agent settings of an inbox', function () {
    $client = mockClient('PATCH', 'inboxes/b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c/agent', [
        'instructions' => null,
        'tone' => 'expanded_professional',
        'actions' => [],
    ], [], [
        'object' => 'inbox_agent',
        'id' => 'c3d4e5f6-a7b8-4c9d-8e0f-1a2b3c4d5e6f',
    ]);

    $result = $client->inboxes->agent->update('b4f2c6a1-3d5e-4f7a-9b8c-1d2e3f4a5b6c', [
        'instructions' => null,
        'tone' => 'expanded_professional',
        'actions' => [],
    ]);

    expect($result)->toBeInstanceOf(Agent::class)
        ->object->toBe('inbox_agent')
        ->id->toBe('c3d4e5f6-a7b8-4c9d-8e0f-1a2b3c4d5e6f');
});
