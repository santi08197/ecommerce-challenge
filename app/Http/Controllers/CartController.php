<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProductService;

class CartController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function index(Request $request)
    {
        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return redirect()->back()->withErrors(['Product not found.']);
        }

        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];

        if (isset($cartItems[$productId])) {
            $cartItems[$productId]['quantity']++;
        } else {
            $cartItems[$productId] = [
                'title' => $product['title'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['images'][0] ?? '',
            ];
        }

        $response = new Response(view('cart.index', compact('cartItems')));
        $response->cookie('cart_items', json_encode($cartItems), 60); 

        return $response;
    }

    public function remove(Request $request, $productId)
    {
        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];
        
        if (isset($cartItems[$productId])) {
            
            unset($cartItems[$productId]);
        }
        
        $response = new Response(view('cart.index', compact('cartItems')));
        $response->cookie('cart_items', json_encode($cartItems), 60); 
        return $response;
    }
}
