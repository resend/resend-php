<?php

function contact(): array
{
    return [
        'id' => 'e169aa45-1ecf-4183-9955-b1499d5701d3',
        'object' => 'contact',
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
            ],
        ],
    ];
}
