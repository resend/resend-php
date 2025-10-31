<?php

function sentAttachment(): array
{
    return [
        'object' => 'attachment',
        'id' => '2a0c9ce0-3112-4728-976e-47ddcd16a318',
        'filename' => 'avatar.png',
        'content_type' => 'image/png',
        'content_disposition' => 'inline',
        'content_id' => 'img001',
        'content' => 'somebase64==',
    ];
}

function sentAttachments(): array
{
    return
    [
        'object' => 'list',
        'data' => [
            [
                'object' => 'attachment',
                'id' => '2a0c9ce0-3112-4728-976e-47ddcd16a318',
                'filename' => 'avatar.png',
                'content_type' => 'image/png',
                'content_disposition' => 'inline',
                'content_id' => 'img001',
                'content' => 'somebase64==',
            ],
        ],
        'has_more' => false,
    ];
}
