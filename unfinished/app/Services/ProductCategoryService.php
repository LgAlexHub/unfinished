<?php

namespace App\Services;

use App\DataTransferObject\ProductCategoryDTO;
use App\Filters\ByRestaurant;
use App\Filters\PaginationHandler;
use App\Models\ProductCategory;
use App\Models\Restaurant;
use Illuminate\Pipeline\Pipeline;

/**
 * ProductCategoryService class contain job code for retrieving/altering product categories
 *
 * @author Aléki <ops.dev.alex@gmail.com>
 *
 * @version 1.0.0
 */
class ProductCategoryService
{
    public function store(ProductCategoryDTO $productCategoryDTO, Restaurant $restaurant): ProductCategory
    {
        return ProductCategory::create([
            'label' => $productCategoryDTO->label,
            'restaurant_id' => $restaurant->id,
        ]);
    }

    public function update(ProductCategoryDTO $productCategoryDTO, ProductCategory $productCategory): ProductCategory
    {
        $productCategory->update([
            'label' => $productCategoryDTO->label,
        ]);

        return $productCategory;
    }

    public function productCategories(
        bool $isPaginated = true,
        int $perPage = 10,
        ?int $restaurantId = null,
    ): mixed {
        $pipes = [
            ...$restaurantId
                ? [new ByRestaurant($restaurantId)]
                : [],
            new PaginationHandler($isPaginated, $perPage),
        ];

        return (new Pipeline())
            ->send(ProductCategory::query())
            ->through($pipes)
            ->thenReturn();
    }

    public function destroy(ProductCategory $productCategory): ?bool
    {
        return $productCategory->delete();
    }
}
