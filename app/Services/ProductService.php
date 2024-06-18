<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProductService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'https://api.escuelajs.co/api/v1';
    }

    public function getAllProducts()
    {
        $response = Http::get($this->apiUrl . '/products');
        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

}
