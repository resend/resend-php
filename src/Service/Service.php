<?php

namespace Resend\Service;

use Resend\ApiKey;
use Resend\Audience;
use Resend\Broadcast;
use Resend\Collection;
use Resend\Contact;
use Resend\Contracts\Transporter;
use Resend\Domain;
use Resend\Email;
use Resend\Emails\Receiving;
use Resend\Resource;

abstract class Service
{
    /**
     * @var array<string, \Resend\Resource>
     */
    protected $mapping = [
        'api-keys' => ApiKey::class,
        'audiences' => Audience::class,
        'broadcasts' => Broadcast::class,
        'contacts' => Contact::class,
        'domains' => Domain::class,
        'emails' => Email::class,
        'receiving' => Receiving::class,
    ];

    /**
     * Create a service instance with the given transporter.
     */
    public function __construct(
        protected readonly Transporter $transporter
    ) {
        //
    }

    /**
     * Create a new resource for the given  with the given attributes.
     */
    protected function createResource(string $resourceType, array $attributes)
    {
        $class = isset($this->mapping[$resourceType]) ? $this->mapping[$resourceType] : Resource::class;

        if (isset($attributes['data']) && is_array($attributes['data'])) {
            foreach ($attributes['data'] as $key => $value) {
                $attributes['data'][$key] = $class::from($value);
            }

            return Collection::from($attributes);
        } else {
            return $class::from($attributes);
        }
    }
}
