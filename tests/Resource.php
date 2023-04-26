<?php

use Resend\Resource;

it('can return an attributes value', function () {
    $resource = new Resource([
        'id' => 're_1234',
        'name' => 'foo',
    ]);

    expect($resource->name)->toBe('foo')
        ->and($resource['name'])->toBe('foo')
        ->and($resource->foo)->toBeNull()
        ->and($resource[null])->toBe(null)
        ->and(isset($resource['name']))->toBeTrue()
        ->and(isset($resource['foo']))->toBeFalse();
});

it('can return an array representation of attributes', function () {
    $array = [
        'id' => 're_1234',
        'name' => 'foo',
    ];

    $resource = new Resource($array);

    $attributes = $resource->toArray();

    expect($attributes)
        ->toBeArray()
        ->toEqual($array);
});

it('can return a JSON representation of attributes', function () {
    $resource = new Resource([
        'name' => 'foo',
    ]);

    $json = $resource->toJson();

    expect($json)->toBe('{"name":"foo"}');
});

it('throws an exception when an offset is set', function () {
    $resource = new Resource([
        'name' => 'foo',
    ]);

    $resource['id'] = 're_123456';
})->throws(BadMethodCallException::class);

it('throws an exception when and offset is unset', function () {
    $resource = new Resource([
        'name' => 'foo',
    ]);

    unset($resource['name']);
})->throws(BadMethodCallException::class);
