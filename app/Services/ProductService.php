<?php

namespace App\Services;

use App\DTOs\CatalogSearchData;
use Ecommerce\Common\DTOs\Product\ProductData;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(
        private HttpClient $httpClient
    ) {
    }

    public function getProducts(
        CatalogSearchData $data
    ): Collection {
        return $this->httpClient
            ->get('products', $data->toArray())
            ->map(
                fn (array $product) => ProductData::fromArray($product)
            );
    }
}
