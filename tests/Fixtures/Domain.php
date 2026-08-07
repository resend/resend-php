<?php

function domain(): array
{
    return [
        'object' => 'domain',
        'id' => 'd91cd9bd-1176-453e-8fc1-35364d380206',
        'name' => 'example.com',
        'status' => 'not_started',
        'created_at' => '2026-04-26 20:21:26.347412+00',
        'region' => 'us-east-1',
        'open_tracking' => true,
        'click_tracking' => false,
        'tracking_subdomain' => 'links',
        'capabilities' => [
            'sending' => 'enabled',
            'receiving' => 'disabled',
        ],
        'records' => [
            [
                'record' => 'SPF',
                'name' => 'send',
                'type' => 'MX',
                'ttl' => 'Auto',
                'status' => 'not_started',
                'value' => 'feedback-smtp.us-east-1.amazonses.com',
                'priority' => 10,
            ],
            [
                'record' => 'SPF',
                'name' => 'send',
                'value' => '"v=spf1 include:amazonses.com ~all"',
                'type' => 'TXT',
                'ttl' => 'Auto',
                'status' => 'not_started',
            ],
            [
                'record' => 'DKIM',
                'name' => 'resend._domainkey',
                'value' => 'p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDsc4Lh8xilsngyKEgN2S84+21gn+x6SEXtjWvPiAAmnmggr5FWG42WnqczpzQ/mNblqHz4CDwUum6LtY6SdoOlDmrhvp5khA3cd661W9FlK3yp7+jVACQElS7d9O6jv8VsBbVg4COess3gyLE5RyxqF1vYsrEXqyM8TBz1n5AGkQIDAQA2',
                'type' => 'TXT',
                'status' => 'not_started',
                'ttl' => 'Auto',
            ],
            [
                'record' => 'Tracking',
                'name' => 'links.example.com',
                'type' => 'CNAME',
                'value' => 'links1.resend-dns.com',
                'ttl' => 'Auto',
                'status' => 'not_started',
            ],
            [
                'record' => 'TrackingCAA',
                'name' => '',
                'type' => 'CAA',
                'value' => '0 issue "amazon.com"',
                'ttl' => 'Auto',
                'status' => 'verified',
            ],
        ],
    ];
}

function domains(): array
{
    return [
        'data' => [
            [
                'id' => 'd91cd9bd-1176-453e-8fc1-35364d380206',
                'name' => 'example.com',
                'status' => 'not_started',
                'created_at' => '2026-04-26 20:21:26.347412+00',
                'region' => 'us-east-1',
                'capabilities' => [
                    'sending' => 'enabled',
                    'receiving' => 'disabled',
                ],
            ],
        ],
    ];
}

function domainClaim(): array
{
    return [
        'object' => 'domain_claim',
        'id' => 'dacf4072-4119-4d88-932f-6c6126d3a9d1',
        'name' => 'example.com',
        'status' => 'pending',
        'domain_id' => 'd91cd9bd-1176-453e-8fc1-35364d380206',
        'region' => 'us-east-1',
        'record' => [
            'type' => 'TXT',
            'name' => 'example.com',
            'value' => 'resend-domain-verification=3f8a1c2d4e5b6a7f8091a2b3c4d5e6f7',
            'ttl' => 'Auto',
        ],
        'blocked_reason' => null,
        'failure_reason' => null,
        'created_at' => '2026-06-16 17:12:02.059593+00',
        'expires_at' => '2026-06-23 17:12:02.059593+00',
    ];
}
