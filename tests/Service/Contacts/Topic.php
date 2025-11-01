<?php

use Resend\Collection;
use Resend\Contact;
use Resend\Contacts\Topic;

it('can get a list of topic resources for a contact by ID', function () {
    $client = mockClient('GET', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3/topics', [], [], contactTopics());

    $result = $client->contacts->topics->get('e169aa45-1ecf-4183-9955-b1499d5701d3');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();

    expect($result->data[0])->toBeInstanceOf(Topic::class);
});

it('can get a list of topic resources for a contact by email', function () {
    $client = mockClient('GET', 'contacts/steve.wozniak@gmail.com/topics', [], [], contactTopics());

    $result = $client->contacts->topics->get('steve.wozniak@gmail.com');

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();

    expect($result->data[0])->toBeInstanceOf(Topic::class);
});

it('can update topic resources for a contact by ID', function () {
    $client = mockClient('PATCH', 'contacts/e169aa45-1ecf-4183-9955-b1499d5701d3/topics', [
        [
            'id' => 'b6d24b8e-af0b-4c3c-be0c-359bbd97381e',
            'subscription' => 'opt_out',
        ],
    ], [], contact());

    $result = $client->contacts->topics->update('e169aa45-1ecf-4183-9955-b1499d5701d3', [
        [
            'id' => 'b6d24b8e-af0b-4c3c-be0c-359bbd97381e',
            'subscription' => 'opt_out',
        ],
    ]);

    expect($result)->toBeInstanceOf(Contact::class)
        ->id->toBe('e169aa45-1ecf-4183-9955-b1499d5701d3');
});
