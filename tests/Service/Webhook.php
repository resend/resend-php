<?php

use Resend\Collection;
use Resend\Webhook;
use Resend\Webhooks\Event as WebhookEvent;
use Resend\Webhooks\EventAttempt;

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

it('can get webhook events with after-only pagination', function () {
    $client = mockClient('GET', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0/events?limit=10&after=msg_cursor', [], [], webhookEvents());

    $result = $client->webhooks->events->list('4dd369bc-aa82-4ff3-97de-514ae3000ee0', [
        'limit' => 10,
        'after' => 'msg_cursor',
        'before' => 'ignored',
    ]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->object->toBe('list')
        ->has_more->toBeFalse()
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(WebhookEvent::class)
        ->status->toBe('success');
});

it('can get a webhook event with its payload and nullable next attempt', function () {
    $client = mockClient('GET', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0/events/msg_1srOrx2ZWZBpBUvZwXKQmoEYga2', [], [], webhookEvent());

    $result = $client->webhooks->events->get('4dd369bc-aa82-4ff3-97de-514ae3000ee0', 'msg_1srOrx2ZWZBpBUvZwXKQmoEYga2');

    expect($result)->toBeInstanceOf(WebhookEvent::class)
        ->object->toBe('webhook_event')
        ->next_attempt_at->toBeNull()
        ->payload->toBeArray()
        ->and($result->payload['data']['email_id'])->toBe('571f1f42-1c2d-4b1f-8f8e-8b3b5b3b5b3b');
});

it('can replay a webhook event', function () {
    $client = mockClient('POST', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0/events/msg_1srOrx2ZWZBpBUvZwXKQmoEYga2/replay', [], [], [
        'object' => 'webhook_event',
        'id' => 'msg_1srOrx2ZWZBpBUvZwXKQmoEYga2',
    ]);

    $result = $client->webhooks->events->replay('4dd369bc-aa82-4ff3-97de-514ae3000ee0', 'msg_1srOrx2ZWZBpBUvZwXKQmoEYga2');

    expect($result)->toBeInstanceOf(WebhookEvent::class)
        ->object->toBe('webhook_event')
        ->id->toBe('msg_1srOrx2ZWZBpBUvZwXKQmoEYga2');
});

it('can get webhook event attempts with after-only pagination', function () {
    $client = mockClient('GET', 'webhooks/4dd369bc-aa82-4ff3-97de-514ae3000ee0/events/msg_1srOrx2ZWZBpBUvZwXKQmoEYga2/attempts?limit=10&after=atmpt_cursor', [], [], webhookEventAttempts());

    $result = $client->webhooks->events->attempts->list(
        '4dd369bc-aa82-4ff3-97de-514ae3000ee0',
        'msg_1srOrx2ZWZBpBUvZwXKQmoEYga2',
        ['limit' => 10, 'after' => 'atmpt_cursor', 'before' => 'ignored']
    );

    expect($result)->toBeInstanceOf(Collection::class)
        ->object->toBe('list')
        ->has_more->toBeFalse()
        ->data->toHaveCount(1)
        ->and($result->data[0])->toBeInstanceOf(EventAttempt::class)
        ->http_status_code->toBe(200)
        ->response->toBe('{"ok":true}');
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
