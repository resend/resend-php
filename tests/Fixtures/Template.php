<?php

function template(): array
{
    return [
        'id' => '34a080c9-b17d-4187-ad80-5af20266e535',
        'object' => 'template',
        'alias' => 'reset-password',
        'name' => 'reset-password',
        'created_at' => '2023-10-06T23:47:56.678Z',
        'updated_at' => '2023-10-06T23:47:56.678Z',
        'status' => 'published',
        'published_at' => '2023-10-06T23:47:56.678Z',
        'from' => 'John Doe <john.doe@example.com>',
        'subject' => 'Hello, world!',
        'reply_to' => null,
        'html' => '<h1>Hello, world!</h1>',
        'text' => 'Hello, world!',
        'variables' => [
            [
                'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
                'key' => 'user_name',
                'type' => 'string',
                'fallback_value' => 'John Doe',
                'created_at' => '2023-10-06T23:47:56.678Z',
                'updated_at' => '2023-10-06T23:47:56.678Z',
            ],
        ],
    ];
}

function templates(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
                'name' => 'reset-password',
                'status' => 'draft',
                'published_at' => null,
                'created_at' => '2023-10-06T23:47:56.678Z',
                'updated_at' => '2023-10-06T23:47:56.678Z',
                'alias' => 'reset-password',
            ],
            [
                'id' => 'b7f9c2e1-1234-4abc-9def-567890abcdef',
                'name' => 'welcome-message',
                'status' => 'published',
                'published_at' => '2023-10-06T23:47:56.678Z',
                'created_at' => '2023-10-06T23:47:56.678Z',
                'updated_at' => '2023-10-06T23:47:56.678Z',
                'alias' => 'welcome-message',
            ],
        ],
        'has_more' => false,
    ];
}
