<?php

namespace App\DataTransferObject;

use Illuminate\Foundation\Http\FormRequest;

readonly class MaterialTypeDTO implements DTOInterface
{
    final public function __construct(
        public string $label
    ) {
    }

    public static function fromRequest(FormRequest $request): static
    {
        return new static(
            label: $request->validated("label")
        );
    }
}
