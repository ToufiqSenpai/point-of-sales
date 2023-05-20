<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Enums\TransactionAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    public function index(Request $request): View
    {
        $po_id = $request->get('id');

        return view('transaction.purchase-order.index', [
            'suppliers' => Supplier::all(),
            'products' => Product::all(),
            'purchase_order' => PurchaseOrder::find($po_id)
        ]);
    }

    public function order(Request $request): RedirectResponse
    {
        $purchase_order = PurchaseOrder::find($request->get('id'));
        if(!$purchase_order) {
            $purchase_order = new PurchaseOrder();
            $purchase_order->save();
        }

        // Make back url
        $back_url = "/transaction/purchase-order?id=". $purchase_order->id;

        switch ($request->get('action')) {
            case TransactionAction::SET_ITEMS:
                $validator = Validator::make($request->all(), [
                    'product_id' => 'required|integer|exists:product,id',
                    'quantity' => 'required|integer|max:999'
                ]);

                if($validator->fails()) break;

                $po_product = $purchase_order->items()->where('product_id', $request['product_id'])->first();

                if($po_product) {
                    $po_product->quantity += (int) $request['quantity'];
                    $po_product->save();
                } else {
                    $purchase_order->items()->create([
                        'quantity' => $request['quantity'],
                        'product_id' => $request['product_id'],
                        'purchase_order_id' => $purchase_order->id
                    ]);
                }

                break;
            case TransactionAction::DELETE_ITEMS:
                $validator = Validator::make($request->all(), [
                    'list_index' => 'required|integer'
                ]);

                if($validator->fails()) break;

                break;
            case TransactionAction::SET_SUPPLIER:
                $validator = Validator::make($request->all(), [
                    'supplier_id' => 'required|integer'
                ]);

                if($validator->fails()) break;

    
                break;
            case TransactionAction::SET_DISCOUNT:
                $validator = Validator::make($request->all(), [
                    'discount' => 'required|integer|max:100'
                ]);

                if($validator->fails()) break;

            
                break;
            case TransactionAction::SET_QUANTITY:
                $validator = Validator::make($request->all(), [
                    'quantity' => 'required|integer|max:999',
                    'item_id' => 'required|integer|exist:purchase_transaction_product'
                ]);

                if($validator->fails()) break;

               

                break;
            case TransactionAction::SET_SHIPPING:
                $validator = Validator::make($request->all(), [
                    'shipping' => 'required|integer|max:9999999'
                ]);

                if($validator->fails()) break;

        

                break;
            case TransactionAction::SET_SUPPLIER:
                $validator = Validator::make($request->all(), [
                    'supplier_id' => 'required|integer'
                ]);

                if($validator->fails()) break;

            

                break;
            case TransactionAction::SET_TAX:
                $validator = Validator::make($request->all(), [
                    'tax' => 'required|integer|max:100'
                ]);

                if($validator->fails()) break;

            

                break;
            default:
                return redirect($back_url)->with('error', 'Purchase action invalid');
        }

        $purchase_order->save();

        return redirect($back_url);
    }

    private function setRedis(string $key, array $value): void
    {
        Redis::set('purchase-order:' . $key, json_encode($value));
    }

    private function getRedis(string $key): array | null
    {
        return json_decode(Redis::get('purchase-order:' . $key));
    }
}
