<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleProduct;

class SalesReport extends Controller
{
    public function index(Request $request)
    {
        $order = $request->get('order', 'created_at');
        $timeFilter = $request->get('time_filter', 'all_time');

        $sales = Sale::getSales($order, $timeFilter);

        if ($request->ajax()) {
            return response()->json(['sales' => $sales]);
        }

        return view('sales.index', compact('sales'));
    }
}
