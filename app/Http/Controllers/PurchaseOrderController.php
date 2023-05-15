<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Enums\TransactionAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    public function index(Request $request): View
    {
        if($request->query('id')) {

        } else {
            
        }

        return view('transaction.purchase-order.index', [
            'suppliers' => Supplier::all(),
            'products' => Product::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $t_id = $request['t-id'];
        switch($request->get('t-id')) {
            case TransactionAction::ADD_PRODUCT:
                
        }
    }
}
