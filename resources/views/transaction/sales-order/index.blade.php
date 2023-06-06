@extends('layouts.dashboard')

@section('title', 'Sales Order')

@section('main')
    @vite('resources\ts\script\transaction\sales-order\index.ts')
    <style>
        @media screen and (min-width: 600px) {
            .input-grid-area {
                grid-area: 1 / 1 / span 3 / span 2;
            }
        }
    </style>
    <div class="grid grid-cols-3 gap-3  ">
        @if($errors->any())
            <x-alert-errors />
        @endif
        <section class="bg-white rounded-md w-full p-3 min-h-full shadow-1 input-grid-area">
            <section class="flex justify-between items-center">
                <p>Tanggal: <time id="transaction-date" datetime="{{ $sales_order?->created_at->toIso8601String() ?? '' }}"></time></p>
                <p>Kasir: {{ Auth::user()->name }}</p>
            </section>
            <select id="customer-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2" required>
                <option selected disabled>Common</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @if($customer->id == $sales_order?->supplier_id) selected @endif>{{ $customer->name }}</option>
                @endforeach
            </select>
            {{-- FORM for set supplier --}}
            <form id="set-customer-form" method="POST" action="/transaction/purchase-order?action=set_supplier">
                <input type="hidden" name="supplier_id" />
                @csrf
            </form>
            <input type="text" id="barcode-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2" placeholder="Barcode">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
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
                            <th scope="col" class="px-6 py-3">
                                Option
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales_order?->items ?? [] as $item)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->product->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4">
                                    ${{ number_format($item->product->base_price) }}
                                </td>
                                <td class="px-6 py-4">
                                    ${{ number_format($item->product->base_price * $item->quantity) }}
                                </td>
                                <td class="px-6 py-4 table-option-dropdown" data-item-id="{{ $item->id }}" data-quantity="{{ $item->quantity }}">
                                    <div class="flex items-center">
                                        <button class="material-icons hover:bg-gray-100 rounded-full p-[2px] cursor-pointer">shopping_basket</button>
                                        <form action="/transaction/purchase-order?id={{ request()->get('id') }}&action=delete_item" method="post">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}" />
                                            <button type="submit" class="material-icons hover:bg-gray-100 rounded-full p-[2px] cursor-pointer">delete</button>
                                        </form>
                                    </div>
                                    <x-modal.input method="POST" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="/transaction/purchase-order/confirm-order?id={{ request()->get('id') }}" method="POST">
                @csrf
                <div class="@if(count($sales_order?>items ?? [])) mt-2 @else mt-[70px] @endif">
                    <label for="cash-input" class="block text-sm font-medium text-gray-900 mb-1">Cash</label>
                    <input type="number" id="cash-input" name="cash" value="{{ old('cash') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="mt-2">
                    <label for="change-input" class="block text-sm font-medium text-gray-900 mb-1">Change</label>
                    <input type="text" id="change-input" data-subtotal="{{ $subtotal }}" class="bg-gray-200 border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="$0" disabled readonly>
                </div>
                <button type="submit" class="focus:outline-none @if(count($sales_order?>items ?? [])) bg-green-400 text-white @else bg-green-500 cursor-not-allowed text-gray-200 @endif hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 mt-2 h-9 w-full" @if(!count($sales_order?>items ?? [])) disabled @endif>CONFIRM ORDER</button>
            </form>
        </section>
        <section class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
            <h1 class="text-4xl font-semibold text-end">${{ $subtotal }}</h1>
        </section>
        <section id="select-product" class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
            <form>
                <input type="text" name="search" value="{{ request()->get('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2" placeholder="Search product...">
            </form>
            <div class="mt-2 grid grid-cols-3">
                @foreach ($products as $product)
                    <form class="max-w-[105px] cursor-pointer" method="POST" action="/transaction/purchase-order?action=set_items">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <div class="w-[105px] h-[105px]">
                            <img src="{{ isset($product->image->name) ? '/storage/product/'. $product->image->name : '/storage/icons/no-picture.png' }}" class="object-cover w-full h-full" />
                        </div>
                        <p class="truncate">{{ $product->name }}</p>
                        <div class="flex items-center mt-1 justify-evenly set-quantity-product">
                            <button type="button" class="h-5 w-5 bg-gray-200 border border-solid border-gray-500 rounded material-icons inc-dec-btn">remove</button>
                            <input type="number" name="quantity" value="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-7 h-6 p-0.5 text-end" required>
                            <button type="button" class="h-5 w-5 bg-gray-200 border border-solid border-gray-500 rounded material-icons inc-dec-btn">add</button>
                        </div>
                        <button type="submit" class="bg-green-400 py-[1px] w-full rounded text-green-800 mt-1 text-sm font-medium">Add</button>
                    </form>
                @endforeach
            </div>
        </section>
    </div>
@endsection
