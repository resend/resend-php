<?php

function trackingDomain(): array
{
    return [
        'object' => 'tracking_domain',
        'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
        'name' => 'links',
        'full_name' => 'links.example.com',
        'status' => 'pending',
        'created_at' => '2026-03-10T12:00:00.000Z',
        'records' => [
            [
                'record' => 'Tracking',
                'type' => 'CNAME',
                'name' => 'links.example.com',
                'value' => '<proxy-target>',
                'ttl' => 'Auto',
                'status' => 'pending',
            ],
        ],
    ];
}

function trackingDomains(): array
{
    return [
        'object' => 'list',
        'data' => [
            [
                'object' => 'tracking_domain',
                'id' => 'a1b2c3d4-e5f6-7890-abcd-ef1234567890',
                'name' => 'links',
                'full_name' => 'links.example.com',
                'status' => 'verified',
                'created_at' => '2026-03-10T12:00:00.000Z',
            ],
        ],
    ];
}
