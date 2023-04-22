<?php

use Resend\Collection;

it('can iterate over the data attribute', function () {
    $collection = new Collection([
        'data' => [
            ['name' => 'Foo'],
            ['name' => 'Bar'],
        ],
    ]);

    foreach ($collection as $item) {
        expect($item)->toHaveKey('name');
    }
});

it('can access string offsets', function () {
    $collection = new Collection([
        'data' => [
            ['name' => 'Foo'],
            ['name' => 'Bar'],
        ],
    ]);

    expect($collection['data'])->toBeArray();
});

it('throws an error when accessing non string offsets', function () {
    $collection = new Collection([
        'data' => [
            ['name' => 'Foo'],
            ['name' => 'Bar'],
        ],
    ]);

    $collection[0];
})->throws(InvalidArgumentException::class);
