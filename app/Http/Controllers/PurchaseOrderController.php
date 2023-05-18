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
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->query('id')) {
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
            'supplier_id' => null,
            'shipping' => null,
            'tax' => null,
            'discount' => null,
            'list_product' => []
        ];
        $order_id = (string) $request->query('id');

        $data = $this->getRedis($order_id); // Get available pair order in redis

        // If the key is setted, set $order to current order
        // Else, make a new order by make a new id for purchase transaction
        $data ? $order = $data : $order_id = Str::uuid();

        // Make back url
        $back_url = "/transaction/purchase-order?id=$order_id";

        switch ($request->get('action')) {
            case TransactionAction::SET_PRODUCT:
                $validator = Validator::make($request->all(), [
                    'product_id' => 'required|integer',
                    'quantity' => 'required|integer|max:999'
                ]);

                if($validator->fails()) break;

                // foreach all order list_product
                foreach ($order['list_product'] as $key => $list) {
                    // If product_id in list product is equal to product_id from request
                    // 
                    if ($list['product_id'] == $request['product_id']) {
                        $order['list_product'][$key]['quantity'] += $request['quantity'];
                    } else {
                        array_push($order['list_product'], [
                            'product_id' => $request['product_id'],
                            'quantity' => 1
                        ]);
                    }
                }

                
                if (empty($order['list_product'])) {
                    array_push($order['list_product'], [
                        'product_id' => $request['product_id'],
                        'quantity' => 1
                    ]);
                }

                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::DELETE_PRODUCT:
                $validator = Validator::make($request->all(), [
                    'list_index' => 'required|integer'
                ]);

                if($validator->fails()) break;

                unset($order['list_product'][$request['product_index']]);
                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::SET_SUPPLIER:
                $validator = Validator::make($request->all(), [
                    'supplier_id' => 'required|integer'
                ]);

                if($validator->fails()) break;

                $order['supplier'] = $request['supplier_id'];
                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::SET_DISCOUNT:
                $validator = Validator::make($request->all(), [
                    'discount' => 'required|integer|max:100'
                ]);

                if($validator->fails()) break;

                $order['discount'] = $request['discount'];
                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::SET_QUANTITY:
                $validator = Validator::make($request->all(), [
                    'quantity' => 'required|integer|max:999',
                    'list_index' => 'required|integer'
                ]);

                if($validator->fails()) break;

                $order['list_product'][$request['list_index']] = $request['quantity'];
                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::SET_SHIPPING:
                $validator = Validator::make($request->all(), [
                    'shipping' => 'required|integer|max:9999999'
                ]);

                if($validator->fails()) break;

                $order['shipping'] = $request['shipping'];
                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::SET_SUPPLIER:
                $validator = Validator::make($request->all(), [
                    'supplier_id' => 'required|integer'
                ]);

                if($validator->fails()) break;

                $order['supplier_id'] = $request['supplier_id'];
                $this->setRedis($order_id, $order);

                break;
            case TransactionAction::SET_TAX:
                $validator = Validator::make($request->all(), [
                    'tax' => 'required|integer|max:100'
                ]);

                if($validator->fails()) break;

                $order['tax'] = $request['tax'];
                $this->setRedis($order_id, $order);

                break;
            default:
                return redirect($back_url)->with('error', 'Purchase action invalid');
        }

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
