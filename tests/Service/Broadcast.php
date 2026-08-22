<?php

use Resend\Broadcast;
use Resend\Broadcasts\Recipient;
use Resend\Client;
use Resend\Collection;
use Resend\Contracts\Transporter;
use Resend\Exceptions\ErrorException;

it('can get a broadcase resource', function () {
    $client = mockClient('GET', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], [], broadcast());

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
    ], [], broadcast());

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
    $client = mockClient('PATCH', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], [], broadcast());

    $result = $client->broadcasts->update('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', []);

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can get a list of broadcast resources', function () {
    $client = mockClient('GET', 'broadcasts', [], [], broadcasts());

    $result = $client->broadcasts->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of broadcast recipients', function () {
    $client = mockClient('GET', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/recipients?type=clicked&limit=20', [], [], broadcastRecipients());

    $result = $client->broadcasts->recipients('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [
        'type' => 'clicked',
        'limit' => 20,
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->has_more->toBeTrue();

    expect($result->data[0])->toBeInstanceOf(Recipient::class)
        ->id->toBe('b2Zmc2V0OjA')
        ->contact_id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3')
        ->email->toBe('carter@example.com')
        ->count->toBe(3)
        ->clicked_links->toBe([
            ['url' => 'https://resend.com/pricing', 'clicks' => 2],
        ]);
});

it('can get a list of bounced broadcast recipients filtered by bounce type', function () {
    $client = mockClient('GET', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/recipients?type=bounced&bounce_type=permanent', [], [], broadcastBouncedRecipients());

    $result = $client->broadcasts->recipients('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [
        'type' => 'bounced',
        'bounce_type' => 'permanent',
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->has_more->toBeFalse();

    expect($result->data[0])->toBeInstanceOf(Recipient::class)
        ->id->toBe('b2Zmc2V0OjE')
        ->contact_id->toBeNull()
        ->email->toBe('dana@example.com')
        ->bounce_type->toBe('permanent');
});

it('cannot get recipients for a broadcast that does not exist', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $transporter->shouldReceive('request')->once()->andThrow(new ErrorException([
        'statusCode' => 404,
        'name' => 'not_found',
        'message' => 'Broadcast not found',
    ]));

    $client = new Client($transporter);

    $client->broadcasts->recipients('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [
        'type' => 'sent',
    ]);
})->throws(ErrorException::class, 'Broadcast not found');

it('can send a broadcast resource', function () {
    $client = mockClient('POST', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/send', [
        'scheduled_at' => 'in 1 min',
    ], [], broadcast());

    $result = $client->broadcasts->send('559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [
        'scheduled_at' => 'in 1 min',
    ]);

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can cancel a broadcast resource', function () {
    $client = mockClient('POST', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b/cancel', [], [], broadcast());

    $result = $client->broadcasts->cancel('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});

it('can remove a broadcast resource', function () {
    $client = mockClient('DELETE', 'broadcasts/559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], [], broadcast());

    $result = $client->broadcasts->remove('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');

    expect($result)->toBeInstanceOf(Broadcast::class)
        ->id->toBe('559ac32e-9ef5-46fb-82a1-b76b840c0f7b');
});
