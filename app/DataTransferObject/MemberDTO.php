<?php

namespace App\DataTransferObject;

use Carbon\Carbon;
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
            first_name: $request->validated('firstName'),
            last_name: $request->validated('lastName'),
            joined_at: new Carbon($request->validated('joinedAt')),
            is_minor: $request->validated('isMinor') ?? false
        );
    }
}
