<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleProduct;

class SalesReport extends Controller
{
    public function index(Request $request)
    {
        $orderBy = $request->get('orderBy', 'created_at');
        $sales = Sale::orderBy($orderBy, 'asc')->get();
        //dd($sales);
        if ($request->ajax()) {
            return response()->json(['sales' => $sales]);
        }

        return view('sales.index', compact('sales'));
    }
}
