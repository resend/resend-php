<?php

use Resend\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('api.resend.com');

    expect($baseUri->toString())->toBe('https://api.resend.com/');
});
