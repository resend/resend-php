<?php

use Resend\Collection;
use Resend\Event;

it('can get a event by id', function () {
    $client = mockClient('GET', 'events/a1b2c3d4-e5f6-7890-abcd-ef1234567890', [], [], event());

    $result = $client->events->get('a1b2c3d4-e5f6-7890-abcd-ef1234567890');

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can get a event by name', function () {
    $client = mockClient('GET', 'events/user.created', [], [], event());

    $result = $client->events->get('user.created');

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can create an event', function () {
    $client = mockClient('POST', 'events', [
        'name' => 'user.created',
        'schema' => [
            'plan' => 'string',
        ],
    ], [], event());

    $result = $client->events->create([
        'name' => 'user.created',
        'schema' => [
            'plan' => 'string',
        ],
    ]);

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can get a list of event', function () {
    $client = mockClient('GET', 'events', [], [], events());

    $result = $client->events->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update an event by id', function () {
    $client = mockClient('PATCH', 'events/a1b2c3d4-e5f6-7890-abcd-ef1234567890', [
        'schema' => [
            'plan' => 'string',
            'trial' => 'boolean',
        ],
    ], [], event());

    $result = $client->events->update('a1b2c3d4-e5f6-7890-abcd-ef1234567890', [
        'schema' => [
            'plan' => 'string',
            'trial' => 'boolean',
        ],
    ]);

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can update an event by name', function () {
    $client = mockClient('PATCH', 'events/user.created', [
        'schema' => [
            'plan' => 'string',
            'trial' => 'boolean',
        ],
    ], [], event());

    $result = $client->events->update('user.created', [
        'schema' => [
            'plan' => 'string',
            'trial' => 'boolean',
        ],
    ]);

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can remove an event by id', function () {
    $client = mockClient('DELETE', 'events/a1b2c3d4-e5f6-7890-abcd-ef1234567890', [], [], event());

    $result = $client->events->remove('a1b2c3d4-e5f6-7890-abcd-ef1234567890');

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can remove an event by name', function () {
    $client = mockClient('DELETE', 'events/user.created', [], [], event());

    $result = $client->events->remove('user.created');

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can send an event with email', function () {
    $client = mockClient('POST', 'events/send', [
        'event' => 'user.created',
        'email' => 'test@example.com',
    ], [], event());

    $result = $client->events->send([
        'event' => 'user.created',
        'email' => 'test@example.com',
    ]);

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('can send an event with contact_id', function () {
    $client = mockClient('POST', 'events/send', [
        'event' => 'user.created',
        'contact_id' => 'user_123',
    ], [], event());

    $result = $client->events->send([
        'event' => 'user.created',
        'contact_id' => 'user_123',
    ]);

    expect($result)->toBeInstanceOf(Event::class)
        ->id->toBe('a1b2c3d4-e5f6-7890-abcd-ef1234567890');
});

it('throws when both email and contact_id are provided', function () {
    $client = mockClient('POST', 'events/send', [], [], event(), null);

    $client->events->send([
        'event' => 'user.created',
        'email' => 'test@example.com',
        'contact_id' => 'user_123',
    ]);
})->throws(InvalidArgumentException::class, 'Either contact_id or email must be provided, but not both.');

it('throws when neither email nor contact_id is provided', function () {
    $client = mockClient('POST', 'events/send', [], [], event(), null);

    $client->events->send([
        'event' => 'user.created',
    ]);
})->throws(InvalidArgumentException::class, 'Either contact_id or email must be provided, but not both.');
