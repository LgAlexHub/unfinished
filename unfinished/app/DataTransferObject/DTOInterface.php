<?php

namespace App\DataTransferObject;

use Illuminate\Http\Request;

interface DTOInterface
{
    public static function fromRequest(Request $request): static;
}
