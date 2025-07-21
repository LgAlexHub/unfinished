<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @author Aleki <alexlegras@hotmail.com>
 * @version 1.0.0
 */
class SortHandler
{
    /**
     * @param array<int, array{name: string, value: bool}>|null $sort
     */
    public function __construct(private ?array $sort)
    {
    }

    /**
     * This method is automatically call in a pipeline
     *
     * @param Builder<\Illuminate\Database\Eloquent\Model> $query
     * @param \Closure $next
     * @return LengthAwarePaginator<Model> | Collection<int, Model>
     */
    public function handle(Builder $query, \Closure $next): Collection | LengthAwarePaginator
    {
        if ($this->sort) {
            foreach ($this->sort as $value) {
                $query->orderBy($value['name'], $value['value'] ? 'ASC' : 'DESC');
            }
        }
        return $next($query);
    }
}
