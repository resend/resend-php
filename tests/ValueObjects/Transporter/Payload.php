<?php

use Resend\Enums\Transporter\ContentType;
use Resend\ValueObjects\ApiKey;
use Resend\ValueObjects\Transporter\BaseUri;
use Resend\ValueObjects\Transporter\Headers;
use Resend\ValueObjects\Transporter\Payload;

it('has a method', function () {
    $payload = Payload::create('email', []);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getMethod())->toBe('POST');
});

it('has a body when making a POST request', function () {
    $payload = Payload::create('email', [
        'to' => 'test@resend.com',
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe(json_encode([
        'to' => 'test@resend.com',
    ]));
});

it('does not have a body when making a GET request', function () {
    $payload = Payload::list('api-keys');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect($payload->toRequest($baseUri, $headers)->getBody()->getContents())->toBe('');
});

it('can create pagination requests', function () {
    $payload = Payload::list('emails', ['limit' => 2, 'after' => 'cursor123', 'before' => 'cursor789']);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect((string) $payload->toRequest($baseUri, $headers)->getUri())->toBe('https://api.resend.com/emails?limit=2&after=cursor123&before=cursor789');
});

it('can create pagination requests with a single option', function () {
    $payload = Payload::list('emails', ['limit' => 2]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    expect((string) $payload->toRequest($baseUri, $headers)->getUri())->toBe('https://api.resend.com/emails?limit=2');
});

it('does not have a body when making a DELETE request', function () {
    $payload = Payload::delete('api-keys', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('')
        ->and($request->getUri()->getPath())->toBe('/api-keys/re_123456');
});

it('can send verify requests with empty body', function () {
    $payload = Payload::verify('domains', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/domains/re_123456/verify');
});

it('can send publish requests with empty body', function () {
    $payload = Payload::publish('templates', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/templates/re_123456/publish');
});

it('can send duplicate requests with empty body', function () {
    $payload = Payload::duplicate('templates', 're_123456');

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/templates/re_123456/duplicate');
});

it('can convert an empty array body to a JSON object', function () {
    $payload = Payload::create('domains', []);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getBody()->getContents())->toBe('{}')
        ->and($request->getUri()->getPath())->toBe('/domains');
});

it('throws an error when using an empty string to get a single resource', function () {
    Payload::get('domains', '');
})->throws(InvalidArgumentException::class, 'The domains ID must be a non-empty string.');

// Multipart form-data tests
it('creates a multipart request with file resource', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test content');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);
    $contentType = $request->getHeaders()['Content-Type'][0];

    expect($contentType)->toContain('multipart/form-data')
        ->and($contentType)->toContain('boundary=');

    fclose($file);
});

it('creates a multipart request with array field', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test content');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
        'column_map' => ['email' => 0, 'name' => 1],
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);
    $body = (string) $request->getBody();

    expect($body)->toContain('column_map')
        ->and($body)->toContain(json_encode(['email' => 0, 'name' => 1]));

    fclose($file);
});

it('creates a multipart request with scalar fields', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test content');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
        'name' => 'import-job',
        'priority' => 'high',
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);
    $body = (string) $request->getBody();

    expect($body)->toContain('name')
        ->and($body)->toContain('import-job')
        ->and($body)->toContain('priority')
        ->and($body)->toContain('high');

    fclose($file);
});

it('includes boundary in multipart content-type header', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);
    $contentType = $request->getHeaders()['Content-Type'][0];
    $parts = explode('; boundary=', $contentType);

    expect(count($parts))->toBe(2)
        ->and($parts[0])->toBe('multipart/form-data')
        ->and(strlen($parts[1]))->toBeGreaterThan(0);

    fclose($file);
});

it('uses correct multipart field names', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test content');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
        'column_map' => ['email' => 0],
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);
    $body = (string) $request->getBody();

    // Multipart format includes field names in content-disposition
    expect($body)->toContain('Content-Disposition: form-data; name="file"')
        ->and($body)->toContain('Content-Disposition: form-data; name="column_map"');

    fclose($file);
});

it('preserves user agent header with multipart', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);

    expect($request->getHeaders()['User-Agent'][0])->toContain('resend-php');

    fclose($file);
});

it('sends multipart request to correct URI', function () {
    $file = fopen('php://memory', 'r+');
    fwrite($file, 'test');
    rewind($file);

    $payload = Payload::upload('contacts/imports', [
        'file' => $file,
    ]);

    $baseUri = BaseUri::from('api.resend.com');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    $request = $payload->toRequest($baseUri, $headers);

    expect((string) $request->getUri())->toBe('https://api.resend.com/contacts/imports');

    fclose($file);
});
