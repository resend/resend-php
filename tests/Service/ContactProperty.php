<?php

use Resend\Collection;
use Resend\ContactProperty;

it('can get a contact property resource', function () {
    $client = mockClient('GET', 'contact-properties/b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [], [], contactProperty());

    $result = $client->contactProperties->get('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');

    expect($result)->toBeInstanceOf(ContactProperty::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});

it('can create a contact property resource', function () {
    $client = mockClient('POST', 'contact-properties', [
        'key' => 'company_name',
        'type' => 'string',
    ], [], contactProperty());

    $result = $client->contactProperties->create([
        'key' => 'company_name',
        'type' => 'string',
    ]);

    expect($result)->toBeInstanceOf(ContactProperty::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});

it('can get a list of contact property resources', function () {
    $client = mockClient('GET', 'contact-properties', [], [], contactProperties());

    $result = $client->contactProperties->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a contact property resource', function () {
    $client = mockClient('PATCH', 'contact-properties/b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [
        'display_name' => 'Company Name',
    ], [], contactProperty());

    $result = $client->contactProperties->update('b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [
        'display_name' => 'Company Name',
    ]);

    expect($result)->toBeInstanceOf(ContactProperty::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});

it('can remove a contact property resource', function () {
    $client = mockClient('DELETE', 'contact-properties/b6d24b8e-af0b-4c3c-be0c-359bbd97381e', [], [], contactProperty());

    $result = $client->contactProperties->remove('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');

    expect($result)->toBeInstanceOf(ContactProperty::class)
        ->id->toBe('b6d24b8e-af0b-4c3c-be0c-359bbd97381e');
});
