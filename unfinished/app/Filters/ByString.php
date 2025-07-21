<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class use in pipeline to retreive model by string query
 *
 * @author Aleki <alexlegras@hotmail.com>
 * @version 1.0.1
 */
class ByString
{
    public function __construct(private string $dbColumnName, private ?string $query)
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
        if ($this->query) {
            $terms = explode(' ', strtolower($this->query));
            $query->where(function ($subQuery) use ($terms) {
                foreach ($terms as $key => $term) {
                    $term = strtolower($term); // Convertir le terme en minuscules
                    if ($key === 0) {
                        $subQuery->whereRaw('LOWER(' . $this->dbColumnName . ') LIKE ?', ['%' . $term . '%']);
                    } else {
                        $subQuery->orWhereRaw('LOWER(' . $this->dbColumnName . ') LIKE ?', ['%' . $term . '%']);
                    }
                }
            });
        }
        return $next($query);
    }
}
