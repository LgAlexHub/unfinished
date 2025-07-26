<?php

namespace App\Services;

use App\Models\Material;
use App\Models\MaterialState;
use Illuminate\Pipeline\Pipeline;
use App\Filters\PaginationHandler;
use Illuminate\Database\Eloquent\Model;
use App\DataTransferObject\DTOInterface;
use App\DataTransferObject\MaterialStateDTO;

class MaterialStateService extends Service
{
    public function store(DTOInterface $dto, ?array $args): Model
    {
        if (! $dto instanceof MaterialStateDTO) {
            throw new \InvalidArgumentException('Expected MaterialStateDTO, got '.get_class($dto));
        }

        if (! (isset($args['material']) && $args['material'] instanceof Material)) {
            throw new \InvalidArgumentException('Expected material, got '.get_class($args['material'] ?? null));
        }

        return MaterialState::create([
            'state' => $dto->state,
            'version' =>  ($args['material']->latestVersion() ?? 0) + 1,
            'material_id' => $args['material']->id
        ]);
    }

    public function update(DTOInterface $dto, Model $model, ?array $args): Model
    {
        return new MaterialState();
    }

    public function collection(DTOInterface $dto, array $args): mixed
    {
        $isPaginated = $args['isPaginated'] ?? true;
        $perPage = $args['perPage'] ?? 10;

        $pipes = [
            // new RelationLoadHandler($withProduct ? [] : []),
            new PaginationHandler($isPaginated, $perPage),
        ];

        return (new Pipeline())
            ->send(MaterialState::query())
            ->through($pipes)
            ->thenReturn();
    }
}
