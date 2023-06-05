<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalesOrderController extends Controller
{
    public function index(Request $request): View 
    {
        $so_id = $request->get('id');
        $sales_order = SalesOrder::find($so_id);

        // Count all subtotal item
        // item_price * quantity + subtotal
        $subtotal = 0;
        foreach($sales_order->items ?? [] as $item) {
            $subtotal += $item->product->base_price * $item->quantity;
        }

        return view('transaction.sales-order.index', [
            'products' => Product::all()
        ]);
    }

    
}
