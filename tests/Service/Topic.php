<?php

use Resend\Collection;
use Resend\Topic;

it('can get a topic', function () {
    $client = mockClient('GET', 'topics/b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [], [], topic());

    $result = $client->topics->get('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');

    expect($result)->toBeInstanceOf(Topic::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});

it('can create a topic resource', function () {
    $client = mockClient('POST', 'topics', [
        'name' => 'Newsletter',
    ], [], topic());

    $result = $client->topics->create([
        'name' => 'Newsletter',
    ]);

    expect($result)->toBeInstanceOf(Topic::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});

it('can get a list of topic resources', function () {
    $client = mockClient('GET', 'topics', [], [], topics());

    $result = $client->topics->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a topic resource', function () {
    $client = mockClient('PATCH', 'topics/b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [
        'name' => 'Weekly Newsletter',
        'description' => 'Weekly newsletter for our subscribers',
    ], [], topic());

    $result = $client->topics->update('b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [
        'name' => 'Weekly Newsletter',
        'description' => 'Weekly newsletter for our subscribers',
    ]);

    expect($result)->toBeInstanceOf(Topic::class);
});

it('can remove a topic resource', function () {
    $client = mockClient('DELETE', 'topics/b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [], [], topic());

    $result = $client->topics->remove('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');

    expect($result)->toBeInstanceOf(Topic::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});
