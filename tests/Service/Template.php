<?php

use Resend\Collection;
use Resend\Template;

it('can get a template resource', function () {
    $client = mockClient('GET', 'templates/34a080c9-b17d-4187-ad80-5af20266e535', [], [], template());

    $result = $client->templates->get('34a080c9-b17d-4187-ad80-5af20266e535');

    expect($result)->toBeInstanceOf(Template::class)
        ->id->toBe('34a080c9-b17d-4187-ad80-5af20266e535');
});

it('can create a template resource', function () {
    $client = mockClient('POST', 'templates', [
        'name' => 'reset-password',
        'html' => '<h1>Hello, world!</h1>',
    ], [], template());

    $result = $client->templates->create([
        'name' => 'reset-password',
        'html' => '<h1>Hello, world!</h1>',
    ]);

    expect($result)->toBeInstanceOf(Template::class)
        ->id->toBe('34a080c9-b17d-4187-ad80-5af20266e535');
});

it('can get a list of template resources', function () {
    $client = mockClient('GET', 'templates', [], [], templates());

    $result = $client->templates->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can update a template resource', function () {
    $client = mockClient('PATCH', 'templates/34a080c9-b17d-4187-ad80-5af20266e535', [
        'html' => '<h1>Hello, world!</h1>',
    ], [], template());

    $result = $client->templates->update('34a080c9-b17d-4187-ad80-5af20266e535', [
        'html' => '<h1>Hello, world!</h1>',
    ]);

    expect($result)->toBeInstanceOf(Template::class)
        ->id->toBe('34a080c9-b17d-4187-ad80-5af20266e535');
});

it('can remove a template resource', function () {
    $client = mockClient('DELETE', 'templates/34a080c9-b17d-4187-ad80-5af20266e535', [], [], [
        'id' => '34a080c9-b17d-4187-ad80-5af20266e535',
        'object' => 'template',
        'deleted' => true,
    ]);

    $result = $client->templates->remove('34a080c9-b17d-4187-ad80-5af20266e535');

    expect($result)->toBeInstanceOf(Template::class)
        ->id->toBe('34a080c9-b17d-4187-ad80-5af20266e535');
});

it('can publish a template resource', function () {
    $client = mockClient('POST', 'templates/34a080c9-b17d-4187-ad80-5af20266e535/publish', [], [], [
        'id' => '34a080c9-b17d-4187-ad80-5af20266e535',
        'object' => 'template',
    ]);

    $result = $client->templates->publish('34a080c9-b17d-4187-ad80-5af20266e535');

    expect($result)->toBeInstanceOf(Template::class)
        ->id->toBe('34a080c9-b17d-4187-ad80-5af20266e535');
});

it('can duplicate a template resource', function () {
    $client = mockClient('POST', 'templates/34a080c9-b17d-4187-ad80-5af20266e535/duplicate', [], [], [
        'id' => '34a080c9-b17d-4187-ad80-5af20266e535',
        'object' => 'template',
    ]);

    $result = $client->templates->duplicate('34a080c9-b17d-4187-ad80-5af20266e535');

    expect($result)->toBeInstanceOf(Template::class)
        ->id->toBe('34a080c9-b17d-4187-ad80-5af20266e535');
});
