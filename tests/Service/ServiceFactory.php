<?php

use Resend\Contracts\Transporter;
use Resend\Service\ApiKey;
use Resend\Service\ServiceFactory;

it('can create a new service instance', function () {
    $transporter = Mockery::mock(Transporter::class);
    $factory = new ServiceFactory($transporter);

    $service = $factory->getService('apiKeys');

    expect($service)
        ->toBeInstanceOf(ApiKey::class);
});

it('can handle non existent services', function () {
    $transporter = Mockery::mock(Transporter::class);
    $factory = new ServiceFactory($transporter);

    $service = $factory->getService('serviceNotFound');

    expect($service)
        ->toBeNull();
});
