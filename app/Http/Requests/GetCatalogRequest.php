<?php

namespace App\Http\Requests;

use Ecommerce\Common\Enums\ProductSortBy;
use Ecommerce\Common\Enums\SortDirection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetCatalogRequest extends FormRequest
{
    public function getSortBy(): ?string
    {
        return $this->input('sortBy');
    }

    public function getSortDirection(): ?string
    {
        return $this->input('sortDirection');
    }

    public function getSearchTerm(): ?string
    {
        return $this->input('searchTerm');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sortBy' => [
                'sometimes',
                new Enum(ProductSortBy::class),
            ],
            'sortDirection' => [
                'sometimes',
                'required_with:sortBy',
                new Enum(SortDirection::class),
            ],
            'searchTerm' => 'sometimes|string|min:1'
        ];
    }
}
