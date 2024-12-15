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
        'created_at' => '2024-12-01T19:32:22.980Z',
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
                'created_at' => '2024-12-01T19:32:22.980Z',
                'scheduled_at' => null,
                'sent_at' => null,
            ],
        ],
    ];
}
