<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class HttpClient
{
    private Client $httpClient;

    public function __construct(private string $baseUrl)
    {
        $this->httpClient = new Client([
            'base_uri' => $baseUrl,
        ]);
    }

    public function get(
        string $url,
        array $queryParams = [],
    ) {
        $content = $this->httpClient
            ->get($url, ['query' => $queryParams])
            ->getBody()
            ->getContents();

        $data = collect(json_decode(
            $content,
            true,
        ));

        return collect(Arr::get($data, 'data', $data));
    }
}
