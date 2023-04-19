<?php

namespace Resend\Service;

use Resend\ApiKey;
use Resend\Collection;
use Resend\Contracts\Transporter;

abstract class Service
{
    /**
     * @var array<string, \Resend\Resource>
     */
    protected $mapping = [
        'api-keys' => ApiKey::class,
    ];

    /**
     * Create a transportable instance with the given transporter.
     */
    public function __construct(
        protected readonly Transporter $transporter
    ) {
        //
    }

    protected function createResource(string $resourceType, array $attributes)
    {
        $class = $this->mapping[$resourceType];

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
