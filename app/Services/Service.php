<?php

namespace App\Services;

use App\DataTransferObject\DTOInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Service
{
    /**
     * @param  Request  $request  Injected HTTP request to get auth user
     */
    public function __construct(protected Request $request)
    {
    }

    abstract public function store(DTOInterface $dto, ?array $args): Model;

    abstract public function update(DTOInterface $dto, Model $model, ?array $args): Model;

    abstract public function collection(DTOInterface $dto, array $args): mixed;

    public function destroy(Model $model): ?bool
    {
        return $model->delete();
    }
}
