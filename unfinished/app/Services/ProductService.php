<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Restaurant;
use App\DataTransferObject\ProductDTO;
use App\Filters\ByRestaurant;
use App\Filters\ByString;
use App\Filters\PaginationHandler;
use App\Filters\RelationLoadHandler;
use App\Filters\SortHandler;
use Illuminate\Pipeline\Pipeline;

/**
 * ProductService class contain job code for retrieving/altering product
 *
 * @author Aléki <ops.dev.alex@gmail.com>
 * @version 1.0.1
 */
class ProductService
{
    /**
     * @param ProductDTO $productDTO
     * @param Restaurant $restaurant
     * @return Product
     */
    public function store(ProductDTO $productDTO, Restaurant $restaurant): Product
    {
        return Product::create([
            'name' => $productDTO->name,
            'product_category_id' => $productDTO->categoryId,
            'restaurant_id' => $restaurant->id,
            'price' => $productDTO->price,
        ]);
    }

    /**
     * @param ProductDTO $productDTO
     * @param Product $product
     * @return Product
     */
    public function update(ProductDTO $productDTO, Product $product): Product
    {
        $product->update([
            'name' => $productDTO->name,
            'product_category_id' => $productDTO->categoryId,
            'price' => $productDTO->price
        ]);
        return $product;
    }

    /**
     * @param boolean $isPaginated
     * @param integer $perPage
     * @param boolean $withCategory
     * @param array{search?: ?string, sort?: ?array<int, array{name: string, value: bool}>}|null $params
     * @return mixed
     */
    public function products(
        bool $isPaginated = true,
        int $perPage = 10,
        bool $withCategory = true,
        ?int $restaurantId = null,
        ?array $params = null,
    ): mixed {
        $pipes = [
            new ByRestaurant($restaurantId),
            new RelationLoadHandler($withCategory ? ['category'] : []),
            new SortHandler($params && array_key_exists('sort', $params) ? $params['sort'] : null),
            new ByString('name', $params && array_key_exists('search', $params) ? $params['search'] : null),
            new PaginationHandler($isPaginated, $perPage)
        ];
        return (new Pipeline())
            ->send(Product::query())
            ->through($pipes)
            ->thenReturn();
    }

    /**
     * @param Product $product
     * @return boolean|null
     */
    public function destroy(Product $product): ?bool
    {
        return $product->delete();
    }
}
