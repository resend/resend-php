<?php

function contactProperty(): array
{
    return [
        'id' => 'b6d24b8e-af0b-4c3c-be0c-359bbd97381e',
        'object' => 'contact_property',
        'key' => 'company_name',
        'type' => 'string',
        'fallback_value' => 'Acme Corp',
        'created_at' => '2023-04-08T00:11:13.110779+00:00',
    ];
}

function contactProperties(): array
{
    return [
        'object' => 'list',
        'has_more' => false,
        'data' => [
            [
                'id' => 'b6d24b8e-af0b-4c3c-be0c-359bbd97381e',
                'object' => 'contact_property',
                'key' => 'company_name',
                'type' => 'string',
                'fallback_value' => 'Acme Corp',
                'created_at' => '2023-04-08T00:11:13.110779+00:00',
            ],
        ],
    ];
}
