<?php

namespace App\Services;

use Ecommerce\Common\DTOs\Warehouse\InventoryData;
use Illuminate\Support\Collection;

class WarehouseService
{
    public function __construct(private readonly HttpClient
    $httpClient)
    {
    }
    public function getAvailableInventories(
        Collection $products
    ): Collection {
        return $this->httpClient
            ->get('inventory/products', [
                'productIds' => $products->pluck('id')->toArray()
            ])
            ->map(
                fn (array $inventory) =>
                new InventoryData(...$inventory)
            );
    }
}
