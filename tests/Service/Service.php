<?php

use Resend\ApiKey;
use Resend\Collection;

it('can create a new resource class from an API response', function () {
    $client = mockClient('POST', 'api-keys', [
        'name' => 'Production',
    ], [], apiKey());

    $apiKeys = $client->apiKeys->create([
        'name' => 'Production',
    ]);

    expect($apiKeys)->toBeInstanceOf(ApiKey::class)
        ->and($apiKeys->id)->toBe('71af5cc3-b449-4ac4-888a-5ab9f55e1dbb');
});

it('can create a new collection class of resources from an API response', function () {
    $client = mockClient('GET', 'api-keys', [], [], apiKeys());

    $apiKeys = $client->apiKeys->list();

    expect($apiKeys)->toBeInstanceOf(Collection::class)
        ->and($apiKeys->data)->toBeArray();
});
