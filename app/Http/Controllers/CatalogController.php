<?php

namespace App\Http\Controllers;

use App\DTOs\CatalogSearchData;
use App\Http\Requests\GetCatalogRequest;
use App\Services\CatalogService;

class CatalogController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService,
    ) {
    }

    public function index(GetCatalogRequest $request)
    {
        $data = new CatalogSearchData(
            $request->getSortBy(),
            $request->getSortDirection(),
            $request->getSearchTerm()
        );

        return [
            'data' => $this->catalogService->getCatalog($data)
        ];
    }
}
