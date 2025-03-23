<?php

use Resend\Broadcast;
use Resend\Collection;

it('can get a broadcase resource', function () {
    $client = mockClient('GET', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], broadcast());

    $result = $client->broadcasts->get('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can create a broadcast resource', function () {
    $client = mockClient('POST', 'broadcasts', [
        'audience_id' => '78261eea-8f8b-4381-83c6-79fa7120f1cf',
        'from' => 'Acme <onboarding@resend.dev>',
        'subject' => 'hello world',
        'html' => 'Hi {{{FIRST_NAME|there}}}, you can unsubscribe here: {{{RESEND_UNSUBSCRIBE_URL}}}',
    ], broadcast());

    $result = $client->broadcasts->create([
        'audience_id' => '78261eea-8f8b-4381-83c6-79fa7120f1cf',
        'from' => 'Acme <onboarding@resend.dev>',
        'subject' => 'hello world',
        'html' => 'Hi {{{FIRST_NAME|there}}}, you can unsubscribe here: {{{RESEND_UNSUBSCRIBE_URL}}}',
    ]);

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can update a broadcast resource', function () {
    $client = mockClient('PATCH', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], broadcast());

    $result = $client->broadcasts->update('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', []);

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can get a list of broadcast resources', function () {
    $client = mockClient('GET', 'broadcasts', [], broadcasts());

    $result = $client->broadcasts->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can send a broadcast resource', function () {
    $client = mockClient('POST', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/send', [
        'scheduled_at' => 'in 1 min',
    ], broadcast());

    $result = $client->broadcasts->send('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [
        'scheduled_at' => 'in 1 min',
    ]);

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can remove a broadcast resource', function () {
    $client = mockClient('DELETE', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], broadcast());

    $result = $client->broadcasts->remove('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});
