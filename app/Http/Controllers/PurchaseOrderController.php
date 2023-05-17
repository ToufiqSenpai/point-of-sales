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
            'supplier_id' => null,
            'shipping' => null,
            'tax' => null,
            'discount' => null,
            'list_product' => []
        ];
        $transaction_id = (string) $request->query('id');
        $search_query = $request->get('search');
        $back_url = "/transaction/purchase-order?id=$transaction_id";

        if($search_query) {
            $back_url. "&search=$search_query";
        }

        // If transaction id is setted, get order data in redis.
        // Else, make a new order data and make uuid.
        if($transaction_id) {
            $data = $this->getRedis($transaction_id);

            // If the key not found, redirect to back url
            if(!$data) $transaction_id = Str::uuid();
            else $order = $data;
        } else {
            $transaction_id = Str::uuid();
        }

        switch($request->get('action')) {
            case TransactionAction::SET_PRODUCT:
                $validator = Validator::make($request->all(), [
                    'product_id' => 'required|integer',
                    'quantity' => 'required|integer|max:999'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                foreach($order['list_product'] as $key => $list) {
                    if($list['product_id'] == $request['product_id']) {
                        $order['list_product'][$key]['quantity'] += $request['quantity'];
                    } else {
                        array_push($order['list_product'], [
                            'product_id' => $request['product_id'],
                            'quantity' => $request['quantity']
                        ]);
                    }
                }

                if(empty($order['list_product'])) {
                    array_push($order['list_product'], [
                        'product_id' => $request['product_id'],
                        'quantity' => $request['quantity']
                    ]);
                }

                $this->setRedis($transaction_id, $order);

                break;
            case TransactionAction::DELETE_PRODUCT:
                $validator = Validator::make($request->all(), [
                    'list_index' => 'required|integer'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                unset($order['list_product'][$request['product_index']]);
                $this->setRedis($transaction_id, $order);

                break;
            case TransactionAction::SET_SUPPLIER:
                $validator = Validator::make($request->all(), [
                    'supplier_id' => 'required|integer'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                $order['supplier'] = $request['supplier_id'];
                $this->setRedis($transaction_id, $order);

                break;
            case TransactionAction::SET_DISCOUNT:
                $validator = Validator::make($request->all(), [
                    'discount' => 'required|integer|max:100'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                $order['discount'] = $request['discount'];
                $this->setRedis($transaction_id, $order);

                break;
            case TransactionAction::SET_QUANTITY:
                $validator = Validator::make($request->all(), [
                    'quantity' => 'required|integer|max:999',
                    'list_index' => 'required|integer'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                $order['list_product'][$request['list_index']] = $request['quantity'];
                $this->setRedis($transaction_id, $order);

                break;
            case TransactionAction::SET_SHIPPING:
                $validator = Validator::make($request->all(), [
                    'shipping' => 'required|integer|max:9999999'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                $order['shipping'] = $request['shipping'];
                $this->setRedis($transaction_id, $order);

                break;
            case TransactionAction::SET_SUPPLIER:
                $validator = Validator::make($request->all(), [
                    'supplier_id' => 'required|integer'
                ]);

                if($validator->fails()) {
                    return redirect($back_url);
                }

                $order['supplier_id'] = $request['supplier_id'];
                $this->setRedis($transaction_id, $order);

                break;
            default:

                break;
        }

        return redirect($back_url);
    }

    private function setRedis(string $key, array $value): void 
    {
        Redis::set('purchase-order:'.$key, json_encode($value));
    }

    private function getRedis(string $key): array | null
    {
        return json_decode(Redis::get('purchase-order:'. $key));
    }
}
