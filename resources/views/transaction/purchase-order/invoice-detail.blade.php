@extends('layouts.dashboard')

@section('title', 'PO Invoice')

@section('main')
    @vite('resources/ts/script/transaction/purchase-order/invoice-detail.ts')
    <div class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
        <header class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-[50px] h-[50px] overflow-hidden ">
                    <img src="/storage/icons/shop.png" class="w-full object-cover" />
                </div>
                <h1 class="text-xl font-medium ml-2">{{ $settings->name }} - Purchase Order Invoice</h1>
            </div>
            <div>
                <p>Date: <time id="invoice-datetime" datetime="{{ $purchase_order->created_at->toIso8601String() }}"></time></p>
                <p>Invoice: {{ $purchase_order->inv_id }}</p>
            </div>
        </header>
        <hr class="my-3" />
        <section>
            <p class="text-base">Supplier: {{ $purchase_order->supplier->name }}</p>
            <p class="text-base">Email: {{ $purchase_order->supplier->email }}</p>
            <p class="text-base">Phone: {{ $purchase_order->supplier->phone }}</p>
            <p class="text-base">Address: {{ $purchase_order->supplier->address }}</p>
        </section>
        <hr class="my-3" />
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    @foreach ($purchase_order->items as $item)
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Subtotal
                            </th>
                        </tr>
                    @endforeach
                </thead>
                <tbody>
                    @foreach($purchase_order->items as $item)
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium">
                                {{ $item->product->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->product->base_price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->product->base_price * $item->quantity }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <section>

        </section>
    </div>
@endsection
