<?php

use Resend\Collection;
use Resend\Segment;

it('can add a contact to a segment', function () {
    $client = mockClient('POST', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3/segments/78261eea-8f8b-4381-83c6-79fa7120f1cf', [], [], segment());

    $result = $client->contacts->segments->add(
        contact: 'e169aa45-1ecf-4183-9955-b1499d5701d3',
        segmentId: '78261eea-8f8b-4381-83c6-79fa7120f1cf'
    );

    expect($result)->toBeInstanceOf(Segment::class)
        ->id->toBe('78261eea-8f8b-4381-83c6-79fa7120f1cf');
});

it('can get a list of segments for a contact by ID', function () {
    $client = mockClient('GET', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3/segments', [], [], segments());

    $result = $client->contacts->segments->list('e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();

    expect($result->data[0])->toBeInstanceOf(Segment::class);
});

it('can remove a contact from a segment', function () {
    $client = mockClient('DELETE', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3/segments/78261eea-8f8b-4381-83c6-79fa7120f1cf', [], [], segment());

    $result = $client->contacts->segments->remove(
        contact: 'e169aa45-1ecf-4183-9955-b1499d5701d3',
        segmentId: '78261eea-8f8b-4381-83c6-79fa7120f1cf'
    );

    expect($result)->toBeInstanceOf(Segment::class)
        ->id->toBe('78261eea-8f8b-4381-83c6-79fa7120f1cf');
});
