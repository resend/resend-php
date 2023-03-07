<?php

namespace Resend\Responses\Email;

use Resend\Concerns\ArrayAccessible;
use Resend\Contracts\Response;

final class Sent implements Response
{
    use ArrayAccessible;

    /**
     * Create a new Email Sent response.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $from,
        public readonly string $to,
        public readonly string $createdAt
    ) {
        //
    }

    /**
     * Create a new Email Sent response from the given attributes.
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['from'],
            $attributes['to'],
            $attributes['created_at']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'created_at' => $this->createdAt,
        ];
    }
}
