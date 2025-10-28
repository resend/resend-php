<?php

use Resend\Collection;
use Resend\Webhook;

it('can get a webhook resource', function () {
    $client = mockClient('GET', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0', [], [], webhook());

    $result = $client->webhooks->get('4dd369bc-aa82-4ff3-97de-514ae3000ee0');

    expect($result)->toBeInstanceOf(Webhook::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});

it('can create a webhook resource', function () {
    $client = mockClient('POST', 'webhooks', [
        'endpoint' => 'https://webhook.example.com/handler',
        'events' => ['email.sent', 'email.delivered', 'email.bounced'],
    ], [], webhook());

    $result = $client->webhooks->create([
        'endpoint' => 'https://webhook.example.com/handler',
        'events' => ['email.sent', 'email.delivered', 'email.bounced'],
    ]);

    expect($result)->toBeInstanceOf(Webhook::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});

it('can get a list of webhook resources', function () {
    $client = mockClient('GET', 'webhooks', [], [], webhooks());

    $result = $client->webhooks->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a webhook resource', function () {
    $client = mockClient('PATCH', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0', [
        'status' => 'enabled',
    ], [], webhook());

    $result = $client->webhooks->update('4dd369bc-aa82-4ff3-97de-514ae3000ee0', [
        'status' => 'enabled',
    ]);

    expect($result)->toBeInstanceOf(Webhook::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});

it('can remove a webhook resource', function () {
    $client = mockClient('DELETE', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0', [], [], webhook());

    $result = $client->webhooks->remove('4dd369bc-aa82-4ff3-97de-514ae3000ee0');

    expect($result)->toBeInstanceOf(Webhook::class)
        ->id->toBe('4dd369bc-aa82-4ff3-97de-514ae3000ee0');
});

it('can verify webhook requests', function () {
    $webhook = webhookRequest(time());

    $verified = Resend::client('re_123456')->webhooks->verify($webhook['payload'], $webhook['headers'], 'MfKQ9r8GKYqrTwjUPD8ILPZIo2LaLaSw', 300);

    expect($verified)->toBeTrue();
});
