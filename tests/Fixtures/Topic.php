<?php

function topic(): array
{
    return [
        'id' => 'b6d24b8e-af0b-4c3c-be0c-359bbd97381e',
        'name' => 'Newsletter',
        'description' => 'Weekly newsletter updates',
        'default_subscription' => 'opt_in',
        'created_at' => '2023-04-07T23:13:52.669661+00:00',
    ];
}

function topics(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'id' => 'b6d24b8e-af0b-4c3c-be0c-359bbd97381e',
                'name' => 'Newsletter',
                'description' => 'Weekly newsletter updates',
                'default_subscription' => 'opt_in',
                'created_at' => '2023-04-07T23:13:52.669661+00:00',
            ],
            [
                'id' => 'ac7503ac-e027-4aea-94b3-b0acd46f65f9',
                'name' => 'Product Updates',
                'description' => 'Product announcements and updates',
                'default_subscription' => 'opt_out',
                'created_at' => '2023-04-07T23:13:20.417116+00:00',
            ],
        ],
    ];
}
