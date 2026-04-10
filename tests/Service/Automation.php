<?php

use Resend\Automation;
use Resend\Collection;

it('can get an automation by id', function () {
    $client = mockClient('GET', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd', [], [], automation());

    $result = $client->automations->get('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');

    expect($result)->toBeInstanceOf(Automation::class)
        ->id->toBe('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');
});

it('can create an automation', function () {
    $client = mockClient('POST', 'automations', [
        'name' => 'Welcome series',
        'status' => 'disabled',
        'steps' => [
            [
                'key' => 'trigger',
                'type' => 'trigger',
                'config' => ['event_name' => 'user.created'],
            ],
        ],
        'edges' => [],
    ], [], automation());

    $result = $client->automations->create([
        'name' => 'Welcome series',
        'status' => 'disabled',
        'steps' => [
            [
                'key' => 'trigger',
                'type' => 'trigger',
                'config' => ['event_name' => 'user.created'],
            ],
        ],
        'edges' => [],
    ]);

    expect($result)->toBeInstanceOf(Automation::class)
        ->id->toBe('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');
});

it('can get a list of automations', function () {
    $client = mockClient('GET', 'automations', [], [], automations());

    $result = $client->automations->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update an automation', function () {
    $client = mockClient('PATCH', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd', [
        'status' => 'enabled',
    ], [], automation());

    $result = $client->automations->update('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd', [
        'status' => 'enabled',
    ]);

    expect($result)->toBeInstanceOf(Automation::class)
        ->id->toBe('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');
});

it('can remove an automation', function () {
    $client = mockClient('DELETE', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd', [], [], automation());

    $result = $client->automations->remove('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');

    expect($result)->toBeInstanceOf(Automation::class)
        ->id->toBe('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');
});

it('can stop an automation', function () {
    $client = mockClient('POST', 'automations/c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd/stop', [], [], automation());

    $result = $client->automations->stop('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');

    expect($result)->toBeInstanceOf(Automation::class)
        ->id->toBe('c9b16d4f-ba6c-4e2e-b044-6bf4404e57fd');
});
