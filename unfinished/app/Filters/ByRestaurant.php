<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class use in pipeline to retreive model by belonged restaurant
 *
 * @author Aleki <alexlegras@hotmail.com>
 * @version 1.0.3
 */
class ByRestaurant
{
    public function __construct(private int|null $restaurantId)
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
        if ($this->restaurantId) {
            $query->where('restaurant_id', $this->restaurantId);
        }
        return $next($query);
    }
}
