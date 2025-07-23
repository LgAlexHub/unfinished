<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class use in pipeline to add pagination handler
 *
 * @author Aleki <alexlegras@hotmail.com>
 *
 * @version 1.0.0
 */
class PaginationHandler
{
    public function __construct(private bool $isPaginatad = true, private int $perPage = 10)
    {
    }

    /**
     * This method is automatically call in a pipeline
     *
     * @param  Builder<\Illuminate\Database\Eloquent\Model>  $query
     */
    public function handle(Builder $query, \Closure $next): mixed
    {
        return $next(
            $this->isPaginatad
            ? $query->paginate($this->perPage)
            : $query->get()
        );
    }
}
