<?php

namespace Resend\Responses\Email;

use Resend\Concerns\ArrayAccessible;
use Resend\Contracts\Response;

final class EmailSent implements Response
{
    use ArrayAccessible;

    public function __construct(
        public readonly string $id,
        public readonly string $from,
        public readonly string $to
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['from'],
            $attributes['to']
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
        ];
    }
}
