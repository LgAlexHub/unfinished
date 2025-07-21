<?php

namespace App\DataTransferObject;

use Illuminate\Http\Request;

readonly class ContactDTO implements DTOInterface
{

    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $phone_number
     * @param string $email
     */
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $phone_number,
        public string $email
    ) {}

    public static function fromRequest(Request $request): static
    {
        return new static(
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            phone_number: $request->validated('phone_number'),
            email : $request->validated('email')
        );
    }
}
