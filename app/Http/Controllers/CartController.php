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
                'id' => $productId,
                'title' => $product['title'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['images'][0] ?? '',
                'category_id' => $product['category']['id'],
            ];
        }
        $action = $request->input('action', 'cart');
        
        if ($action === 'cart') {
            $response = redirect()->route('cart.index');
        } elseif ($action === 'checkout') {
            $response = redirect()->route('checkout.payment');
        }
        $response->cookie('cart_items', json_encode($cartItems), 60);

        return $response;
    }

    public function update(Request $request)
    {
        $cartItems = json_decode($request->cookie('cart_items', '[]'), true);

        $validated = $request->validate([
            'productId' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $validated['productId'];
        $quantity = $validated['quantity'];

        if (isset($cartItems[$productId])) {
            $cartItems[$productId]['quantity'] = $quantity;
        }
     
        $response = redirect()->route('cart.index');
        $response->cookie('cart_items', json_encode($cartItems), 60);
        return $response;
    }
    public function remove(Request $request, $productId)
    {
        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];
        
        if (isset($cartItems[$productId])) {
            
            unset($cartItems[$productId]);
        }
        
        $response = redirect()->route('cart.index');
        $response->cookie('cart_items', json_encode($cartItems), 60);
        return $response;
    }
}
