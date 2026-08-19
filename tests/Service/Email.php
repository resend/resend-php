<?php

use Resend\Client;
use Resend\Collection;
use Resend\Contracts\Transporter;
use Resend\Email;
use Resend\Exceptions\ErrorException;
use Resend\Metrics;

it('can get an email resource', function () {
    $client = mockClient('GET', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [], [], email());

    $result = $client->emails->get('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->message_id->toBe('<111-222-333@email.example.com>');
});

it('can send an email', function () {
    $client = mockClient('POST', 'emails', [
        'to' => 'test@resend.com',
    ], [], email());

    $result = $client->emails->send([
        'to' => 'test@resend.com',
    ]);

    expect($result)
        ->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->from->toBe('onboarding@resend.dev')
        ->to->toBe('user@gmail.com');
});

it('can send an email with an idempotency key', function () {
    $client = mockClient('POST', 'emails', [
        'to' => 'test@resend.com',
    ], [
        'Idempotency-Key' => 'unique-key',
    ], email());

    $result = $client->emails->send(['to' => 'test@resend.com'], ['idempotency_key' => 'unique-key']);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can update a scheduled email', function () {
    $client = mockClient('PATCH', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'scheduled_at' => '2024-08-05T11:52:01.858Z',
    ], [], ['object' => 'email', 'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794']);

    $result = $client->emails->update('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'scheduled_at' => '2024-08-05T11:52:01.858Z',
    ]);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can cancel a scheduled email', function () {
    $client = mockClient('POST', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/cancel', [], [], [
        'object' => 'email',
        'id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
    ]);

    $result = $client->emails->cancel('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can create a shareable link for an email with the default expiration', function () {
    $client = mockClient('POST', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/share', [], [], sharedEmail());

    $result = $client->emails->share('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->url->toBe('https://resend.com/share/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('can create a shareable link for an email with a custom expiration', function () {
    $client = mockClient('POST', 'emails/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794/share', [
        'expires_in' => '10m',
    ], [], sharedEmail());

    $result = $client->emails->share('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'expires_in' => '10m',
    ]);

    expect($result)->toBeInstanceOf(Email::class)
        ->id->toBe('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794')
        ->url->toBe('https://resend.com/share/49a3999c-0ce1-4ea6-ab68-afcd6dc2e794');
});

it('throws when expires_in exceeds the maximum allowed duration', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $transporter
        ->shouldReceive('request')
        ->once()
        ->andThrow(new ErrorException([
            'statusCode' => 422,
            'name' => 'validation_error',
            'message' => 'expires_in must not exceed 48h',
        ]));

    $client->emails->share('49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [
        'expires_in' => '72h',
    ]);
})->throws(ErrorException::class, 'expires_in must not exceed 48h');

it('throws when the email to share does not exist', function () {
    /** @var Mockery\MockInterface|Transporter $transporter */
    $transporter = Mockery::mock(Transporter::class);
    $client = new Client($transporter);

    $transporter
        ->shouldReceive('request')
        ->once()
        ->andThrow(new ErrorException([
            'statusCode' => 404,
            'name' => 'not_found',
            'message' => 'Email not found',
        ]));

    $client->emails->share('00000000-0000-0000-0000-000000000000');
})->throws(ErrorException::class, 'Email not found');

it('can get a list of email resources', function () {
    $client = mockClient('GET', 'emails', [], [], emails());

    $result = $client->emails->list();

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of email resources with a limit', function () {
    $client = mockClient('GET', 'emails?limit=2', [], [], emails());

    $result = $client->emails->list(['limit' => 2]);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of email resources before cursor', function () {
    $client = mockClient('GET', 'emails?before=cursor123', [], [], emails());

    $result = $client->emails->list(['before' => 'cursor123']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get a list of email resources after cursor', function () {
    $client = mockClient('GET', 'emails?after=cursor123', [], [], emails());

    $result = $client->emails->list(['after' => 'cursor123']);

    expect($result)->toBeInstanceOf(Collection::class)
        ->data->toBeArray();
});

it('can get email metrics with no options', function () {
    $client = mockClient('GET', 'emails/metrics', [], [], metrics());

    $result = $client->emails->metrics();

    expect($result)->toBeInstanceOf(Metrics::class)
        ->object->toBe('metrics')
        ->totals->toBe(['delivered' => 100, 'opened' => 40]);
});

it('can get email metrics with the period dimension', function () {
    $client = mockClient('GET', 'emails/metrics?dimensions=period', [], [], metrics([
        'dimensions' => ['period'],
        'data' => [
            ['period' => '2026-07-01', 'delivered' => 10, 'opened' => 4],
        ],
    ]));

    $result = $client->emails->metrics(['dimensions' => ['period']]);

    expect($result)->toBeInstanceOf(Metrics::class)
        ->dimensions->toBe(['period'])
        ->data->toBe([
            ['period' => '2026-07-01', 'delivered' => 10, 'opened' => 4],
        ]);
});

it('can get email metrics with the domain dimension', function () {
    $client = mockClient('GET', 'emails/metrics?dimensions=domain', [], [], metrics([
        'dimensions' => ['domain'],
        'data' => [
            ['domain_id' => 'a6117382-15be-4e5a-b0f5-52d4e0f8c3a1', 'domain_name' => 'example.com', 'delivered' => 10, 'opened' => 4],
        ],
    ]));

    $result = $client->emails->metrics(['dimensions' => ['domain']]);

    expect($result)->toBeInstanceOf(Metrics::class)
        ->dimensions->toBe(['domain']);
});

it('can get email metrics with the email dimension', function () {
    $client = mockClient('GET', 'emails/metrics?dimensions=email', [], [], metrics([
        'dimensions' => ['email'],
        'data' => [
            ['email_id' => '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', 'delivered' => 1, 'opened' => 1],
        ],
    ]));

    $result = $client->emails->metrics(['dimensions' => ['email']]);

    expect($result)->toBeInstanceOf(Metrics::class)
        ->dimensions->toBe(['email']);
});

it('can get email metrics with the broadcast dimension', function () {
    $client = mockClient('GET', 'emails/metrics?dimensions=broadcast', [], [], metrics([
        'dimensions' => ['broadcast'],
        'data' => [
            ['broadcast_id' => '559ac32e-9ef5-46fb-82a1-b76b840c0f7b', 'broadcast_name' => 'July Newsletter', 'delivered' => 10, 'opened' => 4],
        ],
    ]));

    $result = $client->emails->metrics(['dimensions' => ['broadcast']]);

    expect($result)->toBeInstanceOf(Metrics::class)
        ->dimensions->toBe(['broadcast']);
});

it('can filter email metrics by a single domain_id', function () {
    $client = mockClient('GET', 'emails/metrics?domain_id=a6117382-15be-4e5a-b0f5-52d4e0f8c3a1', [], [], metrics());

    $result = $client->emails->metrics(['domain_id' => ['a6117382-15be-4e5a-b0f5-52d4e0f8c3a1']]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('can filter email metrics by multiple domain_id values', function () {
    $client = mockClient('GET', 'emails/metrics?domain_id=a6117382-15be-4e5a-b0f5-52d4e0f8c3a1%2Cb6117382-15be-4e5a-b0f5-52d4e0f8c3a2', [], [], metrics());

    $result = $client->emails->metrics(['domain_id' => [
        'a6117382-15be-4e5a-b0f5-52d4e0f8c3a1',
        'b6117382-15be-4e5a-b0f5-52d4e0f8c3a2',
    ]]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('can filter email metrics by a single email_id', function () {
    $client = mockClient('GET', 'emails/metrics?email_id=49a3999c-0ce1-4ea6-ab68-afcd6dc2e794', [], [], metrics());

    $result = $client->emails->metrics(['email_id' => ['49a3999c-0ce1-4ea6-ab68-afcd6dc2e794']]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('can filter email metrics by multiple email_id values', function () {
    $client = mockClient('GET', 'emails/metrics?email_id=49a3999c-0ce1-4ea6-ab68-afcd6dc2e794%2C59a3999c-0ce1-4ea6-ab68-afcd6dc2e795', [], [], metrics());

    $result = $client->emails->metrics(['email_id' => [
        '49a3999c-0ce1-4ea6-ab68-afcd6dc2e794',
        '59a3999c-0ce1-4ea6-ab68-afcd6dc2e795',
    ]]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('can filter email metrics by a single broadcast_id', function () {
    $client = mockClient('GET', 'emails/metrics?broadcast_id=559ac32e-9ef5-46fb-82a1-b76b840c0f7b', [], [], metrics());

    $result = $client->emails->metrics(['broadcast_id' => ['559ac32e-9ef5-46fb-82a1-b76b840c0f7b']]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('can filter email metrics by multiple broadcast_id values', function () {
    $client = mockClient('GET', 'emails/metrics?broadcast_id=559ac32e-9ef5-46fb-82a1-b76b840c0f7b%2C659ac32e-9ef5-46fb-82a1-b76b840c0f7c', [], [], metrics());

    $result = $client->emails->metrics(['broadcast_id' => [
        '559ac32e-9ef5-46fb-82a1-b76b840c0f7b',
        '659ac32e-9ef5-46fb-82a1-b76b840c0f7c',
    ]]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('passes the metrics filter through as a comma-separated list', function () {
    $client = mockClient('GET', 'emails/metrics?metrics=delivered%2Copened', [], [], metrics());

    $result = $client->emails->metrics(['metrics' => ['delivered', 'opened']]);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('passes the granularity option through', function () {
    $client = mockClient('GET', 'emails/metrics?granularity=weekly', [], [], metrics(['granularity' => 'weekly']));

    $result = $client->emails->metrics(['granularity' => 'weekly']);

    expect($result)->toBeInstanceOf(Metrics::class)
        ->granularity->toBe('weekly');
});

it('passes the timezone option through', function () {
    $client = mockClient('GET', 'emails/metrics?timezone=America%2FNew_York', [], [], metrics());

    $result = $client->emails->metrics(['timezone' => 'America/New_York']);

    expect($result)->toBeInstanceOf(Metrics::class);
});

it('passes the start_date and end_date options through', function () {
    $client = mockClient('GET', 'emails/metrics?start_date=2026-07-01&end_date=2026-07-08', [], [], metrics());

    $result = $client->emails->metrics([
        'start_date' => '2026-07-01',
        'end_date' => '2026-07-08',
    ]);

    expect($result)->toBeInstanceOf(Metrics::class);
});
