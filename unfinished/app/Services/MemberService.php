<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Pipeline\Pipeline;
use App\Filters\PaginationHandler;
use App\Filters\RelationLoadHandler;
use App\DataTransferObject\MemberDTO;
use Illuminate\Database\Eloquent\Model;
use App\DataTransferObject\DTOInterface;

class MemberService extends Service
{

   public function store(DTOInterface $dto, ?array $args): Model
    {
        if (!$dto instanceof MemberDTO) {
            throw new \InvalidArgumentException('Expected MemberDTO, got ' . get_class($dto));
        }

        return Member::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'joined_at' => $dto->joined_at,
            'is_minor' => $dto->is_minor,
        ]);
    }

    /**
     * @param DTOInterface $dto
     * @param Model $model
     * @return Model
     */
    public function update(DTOInterface $dto, Model $model): Model
    {
        if (!$dto instanceof MemberDTO) {
            throw new \InvalidArgumentException('Expected MemberDTO, got ' . get_class($dto));
        }

        if (!$model instanceof Member) {
            throw new \InvalidArgumentException('Expected Member model, got ' . get_class($model));
        }

        $model->update([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'joined_at' => $dto->joined_at,
            'is_minor' => $dto->is_minor,
        ]);

        return $model;
    }

    /**
     * @param DTOInterface $dto
     * @param array $args
     * @return mixed
     */
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

    /**
     * @param Model $model Must be Member
     * @return boolean|null
     */
    public function destroy(Model $model): ?bool
    {
        if (!$model instanceof Member) {
            throw new \InvalidArgumentException('Expected Member model, got ' . get_class($model));
        }

        return $model->delete();
    }
}
