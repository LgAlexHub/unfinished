<?php

namespace App\Services;

use App\Models\Material;
use App\Models\MaterialType;
use Illuminate\Pipeline\Pipeline;
use App\Filters\PaginationHandler;
use Illuminate\Database\Eloquent\Model;
use App\DataTransferObject\DTOInterface;
use App\DataTransferObject\MaterialTypeDTO;

class MaterialTypeService extends Service
{
    public function store(DTOInterface $dto, ?array $args): Model
    {
        if (! $dto instanceof MaterialTypeDTO) {
            throw new \InvalidArgumentException('Expected MaterialTypeDTO, got '.get_class($dto));
        }

        if (! (isset($args['material']) && $args['material'] instanceof Material)) {
            throw new \InvalidArgumentException('Expected material, got '.get_class($args['material'] ?? null));
        }

        return MaterialType::create([
            'label' => $dto->label,
        ]);
    }

    public function update(DTOInterface $dto, Model $model, ?array $args): Model
    {
        if (! $dto instanceof MaterialTypeDTO) {
            throw new \InvalidArgumentException('Expected MaterialTypeDTO, got '.get_class($dto));
        }

        if (! (isset($args['material']) && $args['material'] instanceof Material)) {
            throw new \InvalidArgumentException('Expected material, got '.get_class($args['material'] ?? null));
        }

        return new MaterialType([
            'label' => $dto->label
        ]);
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
            ->send(MaterialType::query())
            ->through($pipes)
            ->thenReturn();
    }
}
