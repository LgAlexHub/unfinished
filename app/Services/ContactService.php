<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Contact;
use Illuminate\Pipeline\Pipeline;
use App\Filters\PaginationHandler;
use App\DataTransferObject\ContactDTO;
use Illuminate\Database\Eloquent\Model;
use App\DataTransferObject\DTOInterface;

class ContactService extends Service
{
    public function store(DTOInterface $dto, ?array $args): Model
    {
        if (! $dto instanceof ContactDTO) {
            throw new \InvalidArgumentException('Expected ContactDTO, got '.get_class($dto));
        }

        if (! (isset($args['member']) && $args['member'] instanceof Member)) {
            throw new \InvalidArgumentException('Expected Member, got '.get_class($args['member'] ?? null));
        }

        return Contact::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'phone_number' => $dto->phone_number,
            'email' => $dto->email,
            'member_id' => $args['member']->id,
        ]);
    }

    public function update(DTOInterface $dto, Model $model, ?array $args): Model
    {
        if (! $dto instanceof ContactDTO) {
            throw new \InvalidArgumentException('Expected ContactDTO, got '.get_class($dto));
        }

        if (! $model instanceof Contact) {
            throw new \InvalidArgumentException('Expected Contact model, got '.get_class($model));
        }

        $model->update([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'phone_number' => $dto->phone_number,
            'email' => $dto->email,
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
            ->send(Contact::query())
            ->through($pipes)
            ->thenReturn();
    }

    /**
     * @param  Model  $model  Must be Contact
     */
    public function destroy(Model $model): ?bool
    {
        if (! $model instanceof Contact) {
            throw new \InvalidArgumentException('Expected Contact model, got '.get_class($model));
        }

        return $model->delete();
    }
}
