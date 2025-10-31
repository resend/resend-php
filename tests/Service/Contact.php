<?php

use Resend\Collection;
use Resend\Contact;

it('can get a contact by id', function () {
    $client = mockClient('GET', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [], [], contact());

    $result = $client->contacts->get('e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a contact by email', function () {
    $client = mockClient('GET', 'contacts/steve.wozniak@gmail.com', [], [], contact());

    $result = $client->contacts->get('steve.wozniak@gmail.com');

    expect($result)->toBeInstanceOf(Contact::class)
        ->email->toBe('steve.wozniak@gmail.com');
});

it('can create a contact', function () {
    $client = mockClient('POST', 'contacts', [
        'email' => 'steve.wozniak@gmail.com',
    ], [], contact());

    $result = $client->contacts->create([
        'email' => 'steve.wozniak@gmail.com',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a list of contacts', function () {
    $client = mockClient('GET', 'contacts', [], [], contacts());

    $result = $client->contacts->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a contact by id', function () {
    $client = mockClient('PATCH', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [
        'first_name' => 'Steve',
    ], [], contact());

    $result = $client->contacts->update('e169aa45-1ecf-4183-9955-b1499d5701d3', [
        'first_name' => 'Steve',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can update a contact by email', function () {
    $client = mockClient('PATCH', 'contacts/steve.wozniak@gmail.com', [
        'first_name' => 'Steve',
    ], [], contact());

    $result = $client->contacts->update('steve.wozniak@gmail.com', [
        'first_name' => 'Steve',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can remove a contact by id', function () {
    $client = mockClient('DELETE', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [], [], contact());

    $result = $client->contacts->remove('e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can remove a contact by email', function () {
    $client = mockClient('DELETE', 'contacts/steve.wozniak@gmail.com', [], [], contact());

    $result = $client->contacts->remove('steve.wozniak@gmail.com');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});
