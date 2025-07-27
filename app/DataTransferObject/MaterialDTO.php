<?php

namespace App\DataTransferObject;

use Illuminate\Foundation\Http\FormRequest;

readonly class MaterialDTO implements DTOInterface
{
    final public function __construct(
        public string $name,
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new static(
            name: $request->validated("name"),
        );
    }
}
