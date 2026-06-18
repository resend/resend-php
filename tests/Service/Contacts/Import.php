<?php

use Resend\Collection;
use Resend\Contacts\Import;

it('can get a contact import resource', function () {
    $client = mockClient('GET', 'contacts/imports/479e3145-dd38-476b-932c-529ceb705947', [], [], contactImport());

    $result = $client->contacts->imports->get('479e3145-dd38-476b-932c-529ceb705947');

    expect($result)->toBeInstanceOf(Import::class)
        ->id->toBe('479e3145-dd38-476b-932c-529ceb705947');
});

it('can create a contact import resource', function () {
    $file = fopen('tests/Fixtures/Contacts/contacts.csv', 'r');
    $client = mockClient('POST', 'contacts/imports', [
        'file' => $file,
    ], [], contactImport());

    $result = $client->contacts->imports->create([
        'file' => $file,
    ]);

    expect($result)->toBeInstanceOf(Import::class)
        ->id->toBe('479e3145-dd38-476b-932c-529ceb705947');
});

it('can get a list of contact import resources', function () {
    $client = mockClient('GET', 'contacts/imports', [], [], contactImports());

    $result = $client->contacts->imports->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});
