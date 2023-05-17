<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Enums\TransactionAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

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

    public function order(Request $request): RedirectResponse
    {
        $order = [
            'supplier' => null,
            'shipping' => null,
            'tax' => null,
            'discount' => null,
            'list_product' => []
        ];
        $transaction_id = $request['t-id'];
        $back_url = "/transaction/purchase-order?t-id=$transaction_id";

        if($transaction_id) {
            $order = $this->getRedis($transaction_id);
        } else {
            $transaction_id = Str::uuid();
        }

        switch($request->get('action')) {
            case TransactionAction::ADD_PRODUCT:
                $request->validate([
                    
                ]);

                array_push($order['list_product'], [
                    'product_id' => $request['product_id'],
                    'quantity' => $request['quantity']
                ]);
                $this->setRedis($transaction_id, $order);

                return redirect($back_url);
            case TransactionAction::DELETE_PRODUCT:
                unset($order['list_product'][$request['product_index']]);
                $this->setRedis($transaction_id, $order);

                return redirect($back_url);
            case TransactionAction::SET_SUPPLIER:
                $order['supplier'] = $request['supplier_id'];
                $this->setRedis($transaction_id, $order);

                return redirect($back_url);
            case TransactionAction::SET_DISCOUNT:

        }
    }

    private function setRedis(string $key, array $value): void 
    {
        Redis::set('purchase-order:'.$key, json_encode($value));
    }

    private function getRedis(string $key): array
    {
        return json_decode(Redis::get('purchase-order:'. $key));
    }
}
