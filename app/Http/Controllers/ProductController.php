<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        //dd($products);
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }

}
