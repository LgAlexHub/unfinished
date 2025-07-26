<?php

namespace App\DataTransferObject;

use Illuminate\Foundation\Http\FormRequest;

readonly class MaterialStateDTO implements DTOInterface
{
    final public function __construct(
        public string $state
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new static(
            state: $request->validated("state")
        );
    }
}
