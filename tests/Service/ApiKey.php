<?php

use Resend\ApiKey;

it('can delete an API key resource', function () {
    $client = mockClient('DELETE', 'api-keys/71af5cc3-b449-4ac4-888a-5ab9f55e1dbb', [], [], apiKey());

    $result = $client->apiKeys->remove('71af5cc3-b449-4ac4-888a-5ab9f55e1dbb');

    expect($result)->toBeInstanceOf(ApiKey::class);
});
