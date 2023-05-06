<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    public function index(): View
    {
        return view('transaction.purchase-order.index', [
            'suppliers' => Supplier::all(),
            'products' => json_encode(Product::all())
        ]);
    }
}
