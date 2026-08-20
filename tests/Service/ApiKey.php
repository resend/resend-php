<?php

use Resend\ApiKey;
use Resend\Client;
use Resend\Contracts\Transporter;
use Resend\Exceptions\ErrorException;

it('can update an API key resource', function () {
    $client = mockClient('PATCH', 'api-keys/71af5cc3-b449-4ac4-888a-5ab9f55e1dbb', [
        'name' => 'Updated name',
    ], [], [
        'object' => 'api_key',
        'id' => '71af5cc3-b449-4ac4-888a-5ab9f55e1dbb',
    ]);

    $result = $client->apiKeys->update('71af5cc3-b449-4ac4-888a-5ab9f55e1dbb', [
        'name' => 'Updated name',
    ]);

    expect($result)->toBeInstanceOf(ApiKey::class)
        ->id->toBe('71af5cc3-b449-4ac4-888a-5ab9f55e1dbb');
});

it('cannot update an API key resource that does not exist', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $transporter->shouldReceive('request')->once()->andThrow(new ErrorException([
        'statusCode' => 404,
        'name' => 'not_found',
        'message' => 'API key not found',
    ]));

    $client = new Client($transporter);

    $client->apiKeys->update('71af5cc3-b449-4ac4-888a-5ab9f55e1dbb', [
        'name' => 'Updated name',
    ]);
})->throws(ErrorException::class, 'API key not found');

it('can delete an API key resource', function () {
    $client = mockClient('DELETE', 'api-keys/71af5cc3-b449-4ac4-888a-5ab9f55e1dbb', [], [], apiKey());

    $result = $client->apiKeys->remove('71af5cc3-b449-4ac4-888a-5ab9f55e1dbb');

    expect($result)->toBeInstanceOf(ApiKey::class);
});
