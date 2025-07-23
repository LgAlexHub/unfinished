<?php

namespace App\DataTransferObject;

use Illuminate\Foundation\Http\FormRequest;

readonly class ContactDTO implements DTOInterface
{
    final public function __construct(
        public string $first_name,
        public string $last_name,
        public string $phone_number,
        public string $email
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new static(
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            phone_number: $request->validated('phone_number'),
            email : $request->validated('email')
        );
    }
}
