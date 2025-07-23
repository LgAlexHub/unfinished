<?php

namespace App\DataTransferObject;

use Illuminate\Foundation\Http\FormRequest;

interface DTOInterface
{
    public static function fromRequest(FormRequest $request): static;
}
