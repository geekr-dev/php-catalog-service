<?php

namespace App\Services;

use App\DTOs\CatalogData;
use App\DTOs\CatalogSearchData;
use Illuminate\Support\Collection;

class CatalogService
{
    public function __construct(
        public readonly ProductService $productService,
        public readonly WarehouseService $warehouseService,
        public readonly RatingService $ratingService,
    ) {
    }

    /**
     * @return Collection<CatalogData>
     */
    public function getCatalog(CatalogSearchData $data): Collection
    {
        // 商品
        $products = $this->productService->getProducts($data);
        if ($products->isEmpty()) {
            return collect([]);
        }
        // 库存
        $inventories = $this->warehouseService->getAvailableInventories($products);
        // 评分
        $ratings = $this->ratingService->getRatings($products);
        // 聚合
        $catalog = [];
        foreach ($products as $product) {
            $inventory = $inventories->firstWhere('productId', $product->id);
            $rating = $ratings->firstWhere('productId', $product->id);
            // 不展示库存为空的商品
            if (!$inventory || $inventory->quantity === 0.0) {
                continue;
            }
            // 聚合商品、对应的评分、库存数据
            $catalog[] = new CatalogData(
                $product->uuid,
                $product->name,
                $product->description,
                $product->price,
                $rating->score,
                $inventory->quantity,
            );
        }
        // 返回最终结果
        return collect($catalog);
    }
}
