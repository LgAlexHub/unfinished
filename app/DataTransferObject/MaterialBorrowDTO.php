<?php

namespace App\DataTransferObject;

use DateTimeInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class MaterialBorrowDTO implements DTOInterface
{
    final public function __construct(
        public ?DateTimeInterface $borrowed_at,
        public ?DateTimeInterface $returned_at,
        public int $member_id
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new static(
           borrowed_at: $request->validated("borrowed_at"),
           returned_at: $request->validated("returned_at"),
           member_id: $request->validated("member_id")
        );
    }
}
