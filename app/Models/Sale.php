<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'payment_method'];
    
    public function salesProduct()
    {
        return $this->hasMany(SaleProduct::class);
    }


    public static function getSales($order = 'created_at', $timeFilter = 'all_time')
    {
        $query = self::select('sales.*', DB::raw('SUM(sale_products.quantity) as quantity'))
            ->join('sale_products', 'sales.id', '=', 'sale_products.sale_id')
            ->groupBy('sales.id')
            ->orderBy($order, 'desc');

        switch ($timeFilter) {
            case 'this_week':
                $query->whereBetween('sales.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereBetween('sales.created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                break;
            case 'this_year':
                $query->whereBetween('sales.created_at', [now()->startOfYear(), now()->endOfYear()]);
                break;
            case 'all_time':
            default:
                break;
        }

        return $query->get();
    }
}
