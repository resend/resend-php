<?php

function contact(): array
{
    return [
        'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
        'object' => 'contact',
        'email' => 'steve.wozniak@gmail.com',
        'first_name' => 'Steve',
        'last_name' => 'Wozniak',
        'created_at' => '2023-10-06T23:47:56.678Z',
        'unsubscribed' => false,
    ];
}

function contacts(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
                'object' => 'contact',
                'email' => 'steve.wozniak@gmail.com',
                'first_name' => 'Steve',
                'last_name' => 'Wozniak',
                'created_at' => '2023-10-06T23:47:56.678Z',
                'unsubscribed' => false,
            ],
        ],
    ];
}
