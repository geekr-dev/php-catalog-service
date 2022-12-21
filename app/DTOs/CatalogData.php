<?php

namespace App\DTOs;

class CatalogData
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $name,
        public readonly string $description,
        public readonly float $price,
        public readonly ?float $averageRating,
        public readonly float $availableQuantity
    ) {
    }
}
