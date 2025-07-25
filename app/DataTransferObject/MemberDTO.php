<?php

namespace App\DataTransferObject;

use DateTimeInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class MemberDTO implements DTOInterface
{
    final public function __construct(
        public string $first_name,
        public string $last_name,
        public DateTimeInterface $joined_at,
        public bool $is_minor
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new static(
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            joined_at: $request->validated('joined_at'),
            is_minor: $request->validated('is_minor') ?? false
        );
    }
}
