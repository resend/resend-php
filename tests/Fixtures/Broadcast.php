<?php

function broadcast(): array
{
    return [
        'id' => '559ac32e-9ef5-46fb-82a1-b76b840c0f7b',
        'object' => 'broadcast',
        'name' => 'Announcements',
        'audience_id' => '78261eea-8f8b-4381-83c6-79fa7120f1cf',
        'from' => 'Acme <onboarding@resend.dev>',
        'subject' => 'hello world',
        'reply_to' => null,
        'preview_text' => 'Check out our latest announcements',
        'status' => 'draft',
        'created_at' => '2024-12-01 19:32:22.98+00',
        'scheduled_at' => null,
        'sent_at' => null,
    ];
}

function broadcasts(): array
{
    return [
        'data' => [
            [
                'id' => '559ac32e-9ef5-46fb-82a1-b76b840c0f7b',
                'object' => 'broadcast',
                'name' => 'Announcements',
                'audience_id' => '78261eea-8f8b-4381-83c6-79fa7120f1cf',
                'from' => 'Acme <onboarding@resend.dev>',
                'subject' => 'hello world',
                'reply_to' => null,
                'preview_text' => 'Check out our latest announcements',
                'status' => 'draft',
                'created_at' => '2024-12-01 19:32:22.98+00',
                'scheduled_at' => null,
                'sent_at' => null,
            ],
        ],
    ];
}

function broadcastRecipients(): array
{
    return [
        'object' => 'list',
        'has_more' => true,
        'data' => [
            [
                'id' => 'b2Zmc2V0OjA',
                'contact_id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
                'email' => 'carter@example.com',
                'count' => 3,
                'clicked_links' => [
                    ['url' => 'https://resend.com/pricing', 'clicks' => 2],
                ],
            ],
        ],
    ];
}

function broadcastBouncedRecipients(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'b2Zmc2V0OjE',
                'contact_id' => null,
                'email' => 'dana@example.com',
                'bounce_type' => 'permanent',
            ],
        ],
    ];
}
