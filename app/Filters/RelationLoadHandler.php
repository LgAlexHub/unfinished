<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class use in pipeline to load relation
 *
 * @author Aleki <alexlegras@hotmail.com>
 *
 * @version 1.0.0
 */
class RelationLoadHandler
{
    /**
     * @param  list<string>  $relationships
     */
    public function __construct(private array $relationships = [])
    {
    }

    /**
     * This method is automatically call in a pipeline
     *
     * @param  Builder<\Illuminate\Database\Eloquent\Model>  $query
     */
    public function handle(Builder $query, \Closure $next): mixed
    {
        return $next(count($this->relationships) > 0
            ? $query->with($this->relationships)
            : $query);
    }
}
