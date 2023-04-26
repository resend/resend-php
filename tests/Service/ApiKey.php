<?php

use Resend\ApiKey;

it('can delete an API key resource', function () {
    $client = mockClient('DELETE', 'api-keys/re_123456', [], apiKey());

    $result = $client->apiKeys->remove('re_123456');

    expect($result)->toBeInstanceOf(ApiKey::class);
});
