<?php

namespace App\Services;

use App\DataTransferObject\DTOInterface;
use App\DataTransferObject\MemberDTO;
use App\Filters\PaginationHandler;
use App\Filters\RelationLoadHandler;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class MemberService extends Service
{
    public function store(DTOInterface $dto, ?array $args): Model
    {
        if (! $dto instanceof MemberDTO) {
            throw new \InvalidArgumentException('Expected MemberDTO, got '.get_class($dto));
        }

        return Member::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'joined_at' => $dto->joined_at,
            'is_minor' => $dto->is_minor,
        ]);
    }

    public function update(DTOInterface $dto, Model $model, ?array $args): Model
    {
        if (! $dto instanceof MemberDTO) {
            throw new \InvalidArgumentException('Expected MemberDTO, got '.get_class($dto));
        }

        if (! $model instanceof Member) {
            throw new \InvalidArgumentException('Expected Member model, got '.get_class($model));
        }

        $model->update([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'joined_at' => $dto->joined_at,
            'is_minor' => $dto->is_minor,
        ]);

        return $model;
    }

    public function collection(DTOInterface $dto, array $args): mixed
    {
        $isPaginated = $args['isPaginated'] ?? true;
        $perPage = $args['perPage'] ?? 10;
        $withProduct = $args['withProduct'] ?? true;

        $pipes = [
            new RelationLoadHandler($withProduct ? [] : []),
            new PaginationHandler($isPaginated, $perPage),
        ];

        return (new Pipeline())
            ->send(Member::query())
            ->through($pipes)
            ->thenReturn();
    }

}
