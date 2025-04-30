<?php

use Resend\Client;
use Resend\Collection;
use Resend\Contact;
use Resend\Contracts\Transporter;

it('can get a contact by id in an audience', function () {
    $client = mockClient('GET', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [], [], contact());

    $result = $client->contacts->get(audienceId: '78261eea-8f8b-4381-83c6-79fa7120f1cf', id: 'e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a contact by email in an audience', function () {
    $client = mockClient('GET', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/steve.wozniak@gmail.com', [], [], contact());

    $result = $client->contacts->get(audienceId: '78261eea-8f8b-4381-83c6-79fa7120f1cf', email: 'steve.wozniak@gmail.com');

    expect($result)->toBeInstanceOf(Contact::class)
        ->email->toBe('steve.wozniak@gmail.com');
});

it('throws an error when getting a contact by email and id in an audience', function () {
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $client->contacts->get(audienceId: '78261eea-8f8b-4381-83c6-79fa7120f1cf', id: 'e169aa45-1ecf-4183-9955-b1499d5701d3', email: 'steve.wozniak@gmail.com');
})->throws(InvalidArgumentException::class, 'You must provide either an ID or an email, but not both.');

it('throws an error when an id or email is not provided to get a contact in an audience', function () {
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $client->contacts->get(audienceId: '78261eea-8f8b-4381-83c6-79fa7120f1cf');
})->throws(InvalidArgumentException::class, 'You must provide either an ID or an email, but not both.');

it('can create a contact in an audience', function () {
    $client = mockClient('POST', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts', [
        'email' => 'steve.wozniak@gmail.com',
    ], [], contact());

    $result = $client->contacts->create('78261eea-8f8b-4381-83c6-79fa7120f1cf', [
        'email' => 'steve.wozniak@gmail.com',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can get a list of contacts in an audience', function () {
    $client = mockClient('GET', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts', [], [], contacts());

    $result = $client->contacts->list('78261eea-8f8b-4381-83c6-79fa7120f1cf');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a contact in an audience', function () {
    $client = mockClient('PATCH', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [
        'first_name' => 'Steve',
    ], [], contact());

    $result = $client->contacts->update('78261eea-8f8b-4381-83c6-79fa7120f1cf', 'e169aa45-1ecf-4183-9955-b1499d5701d3', [
        'first_name' => 'Steve',
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can remove a contact in an audience', function () {
    $client = mockClient('DELETE', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/e169aa45-1ecf-4183-9955-b1499d5701d3', [], [], contact());

    $result = $client->contacts->remove(audienceId: '78261eea-8f8b-4381-83c6-79fa7120f1cf', id: 'e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});

it('can remove a contact in an audience using an email', function () {
    $client = mockClient('DELETE', 'audiences/78261eea-8f8b-4381-83c6-79fa7120f1cf/contacts/acme@example.com', [], [], contact());

    $result = $client->contacts->remove(audienceId: '78261eea-8f8b-4381-83c6-79fa7120f1cf', id: 'acme@example.com');

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});
