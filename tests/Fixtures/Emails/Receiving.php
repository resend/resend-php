<?php

function inboundEmail(): array
{
    return [
        'object' => 'email',
        'id' => '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
        'to' => ['delivered@resend.dev'],
        'from' => 'Acme <onboarding@resend.dev>',
        'created_at' => '2023-04-03T22:13:42.674981+00:00',
        'subject' => 'Hello World',
        'html' => 'Congrats on sending your <strong>first email</strong>!',
        'text' => null,
        'bcc' => [],
        'cc' => [],
        'reply_to' => [],
        'message_id' => '<example+123>',
        'attachments' => [
            [
                'id' => '2a0c9ce0-3112-4728-976e-47ddcd16a318',
                'filename' => 'avatar.png',
                'content_type' => 'image/png',
                'content_disposition' => 'inline',
                'content_id' => 'img001',
            ],
        ],
    ];
}

function inboundEmails(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'object' => 'email',
                'id' => '4ef9a417-02e9-4d39-ad75-9611e0fcc33c',
                'to' => ['delivered@resend.dev'],
                'from' => 'Acme <onboarding@resend.dev>',
                'created_at' => '2023-04-03T22:13:42.674981+00:00',
                'subject' => 'Hello World',
                'html' => 'Congrats on sending your <strong>first email</strong>!',
                'text' => null,
                'bcc' => [],
                'cc' => [],
                'reply_to' => [],
                'message_id' => '<example+123>',
                'attachments' => [
                    [
                        'id' => '2a0c9ce0-3112-4728-976e-47ddcd16a318',
                        'filename' => 'avatar.png',
                        'content_type' => 'image/png',
                        'content_disposition' => 'inline',
                        'content_id' => 'img001',
                    ],
                ],
            ],
        ],
        'has_more' => false,
    ];
}
