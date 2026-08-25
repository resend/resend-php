<?php

function broadcastClickedLinks(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'b2Zmc2V0OjA',
                'url' => 'https://resend.com/pricing',
                'clicks' => 42,
                'unique_clicks' => 30,
            ],
            [
                'id' => 'b2Zmc2V0OjE',
                'url' => 'https://resend.com/docs',
                'clicks' => 17,
                'unique_clicks' => 15,
            ],
        ],
    ];
}
