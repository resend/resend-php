<?php

use Resend\Webhooks\EmailEventData;
use Resend\Webhooks\EmailReceivedEvent;
use Resend\Webhooks\EmailSentEvent;
use Resend\Webhooks\ReceivedEmailEventData;

it('can parse an email sent webhook event with message_id', function () {
    $event = EmailSentEvent::from(emailSentWebhookEvent());

    expect($event)->toBeInstanceOf(EmailSentEvent::class)
        ->type->toBe('email.sent')
        ->and($event->data)->toBeArray()
        ->and($event->data['message_id'])->toBe('<111-222-333@email.example.com>');
});

it('can parse email event data with message_id', function () {
    $data = EmailEventData::from(emailWebhookEventData());

    expect($data)->toBeInstanceOf(EmailEventData::class)
        ->email_id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->message_id->toBe('<111-222-333@email.example.com>');
});

it('can parse an email received webhook event with message_id', function () {
    $event = EmailReceivedEvent::from(emailReceivedWebhookEvent());

    expect($event)->toBeInstanceOf(EmailReceivedEvent::class)
        ->type->toBe('email.received')
        ->and($event->data)->toBeArray()
        ->and($event->data['message_id'])->toBe('<example+123@email.example.com>');
});

it('can parse received email event data with message_id', function () {
    $data = ReceivedEmailEventData::from(receivedEmailWebhookEventData());

    expect($data)->toBeInstanceOf(ReceivedEmailEventData::class)
        ->email_id->toBe('4ef9a417-02e9-4d39-ad75-9611e0fcc33c')
        ->message_id->toBe('<example+123@email.example.com>')
        ->received_for->toBe(['forwarded@example.com']);
});
