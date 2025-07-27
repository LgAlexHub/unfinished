<?php

namespace App\Services;

use App\Models\Material;
use Illuminate\Pipeline\Pipeline;
use App\Filters\PaginationHandler;
use Illuminate\Database\Eloquent\Model;
use App\DataTransferObject\DTOInterface;
use App\DataTransferObject\MaterialBorrowDTO;
use App\DataTransferObject\MaterialDTO;
use App\Exceptions\MaterialAlreadyBorrowedException;
use App\Models\Member;
use Carbon\Carbon;
use Error;

class MaterialService extends Service
{
    public function store(DTOInterface $dto, ?array $args): Model
    {
        if (! $dto instanceof MaterialDTO) {
            throw new \InvalidArgumentException('Expected MaterialDTO, got ' . get_class($dto));
        }

        return Material::create([
            'name' => $dto->name,
        ]);
    }


    public function addBorrow(Material $model, MaterialBorrowDTO $materialBorrowDTO): int
    {
        $lastBorrower = $model->lastBorrower();
        $borrower = Member::findOrFail($materialBorrowDTO->member_id);
        $borrowAt = $materialBorrowDTO->borrowed_at ?? now();

        if ($lastBorrower && $lastBorrower->pivot->returned_at === null) {
            throw new MaterialAlreadyBorrowedException($model, $borrower, $materialBorrowDTO->borrowed_at, $borrowAt);
        }

        $model->borrowers()->attach($materialBorrowDTO->member_id, [
            'borrowed_at' => $borrowAt,
            'returned_at' => null,
        ]);

        $attached = $model->borrowers()
            ->wherePivot('borrowed_at', $borrowAt)
            ->wherePivot('returned_at', null)
            ->where('members.id', $materialBorrowDTO->member_id)
            ->exists();

        return $attached ? 0 : -1;
    }

    public function returnBorrow(Material $model, MaterialBorrowDTO $materialBorrowDTO) : int
    {
        $lastBorrower = $model->lastBorrower();
        $borrower = Member::findOrFail($materialBorrowDTO->member_id);

        if ($lastBorrower->id !== $borrower->id) {
            throw new \Exception("Last borrower has not the same id as current borrower");
        }

        $updated = $model->borrowers()
            ->wherePivot('returned_at', null)
            ->updateExistingPivot($borrower->id, [
                'returned_at' => $materialBorrowDTO->returned_at ?? now()
            ]);
        return $updated > 0 ? 0 : -1;
    }

    public function update(DTOInterface $dto, Model $model, ?array $args): Model
    {
        if (! $dto instanceof MaterialDTO) {
            throw new \InvalidArgumentException('Expected MaterialDTO, got ' . get_class($dto));
        }

        $model->update([
            'name' => $dto->name,
        ]);

        return $model;
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
            ->send(Material::query())
            ->through($pipes)
            ->thenReturn();
    }
}
