<?php

namespace App\Services;

use Ecommerce\Common\DTOs\Rating\ProductRatingData;
use Illuminate\Support\Collection;

class RatingService
{
    public function __construct(
        private readonly HttpClient $httpClient,
    ) {
    }

    public function getRatings(
        Collection $products
    ): Collection {
        return $this->httpClient
            ->get('products/ratings', [
                'productIds' => $products->pluck('id')->toArray()
            ])
            ->map(
                fn (array $rating) => new ProductRatingData(...$rating)
            );
    }
}
