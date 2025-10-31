<?php

use Resend\Collection;
use Resend\Segment;

it('can get a segment resource', function () {
    $client = mockClient('GET', 'segments/78261eea-8f8b-4381-83c6-79fa7120f1cf', [], [], segment());

    $result = $client->segments->get('78261eea-8f8b-4381-83c6-79fa7120f1cf');

    expect($result)->toBeInstanceOf(Segment::class)
        ->id->toBe('78261eea-8f8b-4381-83c6-79fa7120f1cf');
});

it('can create a segment resource', function () {
    $client = mockClient('POST', 'segments', [
        'name' => 'Registered Users',
    ], [], segment());

    $result = $client->segments->create([
        'name' => 'Registered Users',
    ]);

    expect($result)->toBeInstanceOf(Segment::class)
        ->id->toBe('78261eea-8f8b-4381-83c6-79fa7120f1cf');
});

it('can list a segment resource', function () {
    $client = mockClient('GET', 'segments', [], [], segments());

    $result = $client->segments->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can remove a segment resource', function () {
    $client = mockClient('DELETE', 'segments/78261eea-8f8b-4381-83c6-79fa7120f1cf', [], [], segment());

    $result = $client->segments->remove('78261eea-8f8b-4381-83c6-79fa7120f1cf');

    expect($result)->toBeInstanceOf(Segment::class);
});
