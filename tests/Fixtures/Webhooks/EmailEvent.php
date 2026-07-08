<?php

function emailSentWebhookEvent(): array
{
    return [
        'type' => 'email.sent',
        'created_at' => '2024-02-22T23:41:12.126Z',
        'data' => emailWebhookEventData(),
    ];
}

function emailReceivedWebhookEvent(): array
{
    return [
        'type' => 'email.received',
        'created_at' => '2024-02-22T23:41:12.126Z',
        'data' => receivedEmailWebhookEventData(),
    ];
}

function emailWebhookEventData(): array
{
    return [
        'email_id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
        'created_at' => '2024-02-22T23:41:12.126Z',
        'from' => 'onboarding@resend.dev',
        'to' => ['user@gmail.com'],
        'subject' => 'hello world',
        'message_id' => '<111-222-333@email.example.com>',
    ];
}

function receivedEmailWebhookEventData(): array
{
    return [
        'email_id' => '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
        'created_at' => '2024-02-22T23:41:12.126Z',
        'from' => 'onboarding@resend.dev',
        'to' => ['delivered@resend.dev'],
        'bcc' => [],
        'cc' => [],
        'received_for' => ['forwarded@example.com'],
        'message_id' => '<example+123@email.example.com>',
        'subject' => 'Hello World',
        'attachments' => [],
    ];
}
