<?php

use Resend\Audience;
use Resend\Collection;

it('can get a audience resource', function () {
    $client = mockClient('GET', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf', [], [], audience());

    $result = $client->audiences->get('78261eea-8f8b-4381-83c6-79fa7120f1cf');

    expect($result)->toBeInstanceOf(Audience::class)
        ->id->toBe('78261eea-8f8b-4381-83c6-79fa7120f1cf');
});

it('can create an audience resource', function () {
    $client = mockClient('POST', 'audiences', [
        'name' => 'Registered Users',
    ], [], audience());

    $result = $client->audiences->create([
        'name' => 'Registered Users',
    ]);

    expect($result)->toBeInstanceOf(Audience::class)
        ->id->toBe('78261eea-8f8b-4381-83c6-79fa7120f1cf');
});

it('can get a list of audience resources', function () {
    $client = mockClient('GET', 'audiences', [], [], audiences());

    $result = $client->audiences->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can remove a audience resource', function () {
    $client = mockClient('DELETE', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf', [], [], audience());

    $result = $client->audiences->remove('78261eea-8f8b-4381-83c6-79fa7120f1cf');

    expect($result)->toBeInstanceOf(Audience::class);
});
