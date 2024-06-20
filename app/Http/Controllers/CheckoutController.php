<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\SaleProduct;



class CheckoutController extends Controller
{
    public function payment()
    {
        return view('checkout.payment');
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->validate([
            'payment_method' => 'required', 
        ]);

        $request->session()->put('paymentMethod', $paymentMethod);

        return redirect()->route('checkout.review');

    }

    public function review(Request $request)
    {
        $cartItems = $request->cookie('cart_items') ? json_decode($request->cookie('cart_items'), true) : [];
        
        $paymentMethod = $request->session()->get('paymentMethod')['payment_method'];

        return view('checkout.review', [
            'paymentMethod' => $paymentMethod,
            'cartItems' => $cartItems,
        ]);
    }

    public function purchase(Request $request)
    {
        $cartItems = json_decode($request->cookie('cart_items'), true);
        $paymentMethod = $request->session()->get('paymentMethod')['payment_method'];
        
        if (!$cartItems || !$paymentMethod) {
            return redirect()->route('cart.index')->with('error', 'No hay elementos en el carrito o método de pago no seleccionado.');
        }

        try{
			DB::beginTransaction();
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item['quantity'] * $item['price'];
            }
            
            $sale = new Sale;
            $sale->total = $total;
            $sale->payment_method = $paymentMethod;

            if($sale->save()){
                foreach ($cartItems as $item) {
                    SaleProduct::create([
                        'sale_id' => $sale->id,
                        'external_product_id' => $item['id'],
                        'external_category_id' => $item['category_id'], 
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['price'],
                    ]);
                }
            }

            $response = new Response(redirect()->route('checkout.success'));
            $response->withCookie(cookie()->forget('cart_items'));
            
            $request->session()->forget('paymentMethod');
            
            DB::commit();

            return $response;
            
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function success()
    {
        return view('checkout.success');
    }
}
