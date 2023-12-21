<?php

use Resend\Collection;
use Resend\Contact;

it('can get a contact in an audience', function () {
    $client = mockClient('GET', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [], contact());

    $result = $client->contacts->get('78261eea-8f8b-4381-83c6-79fa7120f1cf', 'e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can create a contact in an audience', function () {
    $client = mockClient('POST', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts', [
        'email' => 'steve.wozniak@gmail.com',
    ], contact());

    $result = $client->contacts->create('78261eea-8f8b-4381-83c6-79fa7120f1cf', [
        'email' => 'steve.wozniak@gmail.com',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a list of contacts in an audience', function () {
    $client = mockClient('GET', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts', [], contacts());

    $result = $client->contacts->list('78261eea-8f8b-4381-83c6-79fa7120f1cf');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a contact in an audience', function () {
    $client = mockClient('PUT', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [
        'first_name' => 'Steve',
    ], contact());

    $result = $client->contacts->update('78261eea-8f8b-4381-83c6-79fa7120f1cf', 'e169aa45-1ecf-4183-9955-b1499d5701d3', [
        'first_name' => 'Steve',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can remove a contact in an audience', function () {
    $client = mockClient('DELETE', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [], contact());

    $result = $client->contacts->remove('78261eea-8f8b-4381-83c6-79fa7120f1cf', 'e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});
