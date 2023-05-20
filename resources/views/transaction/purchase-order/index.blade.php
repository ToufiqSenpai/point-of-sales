@extends('layouts.dashboard')

@section('title', 'Purchase Order')

@section('main')
    @vite('resources\ts\script\transaction\purchase-order\index.ts')
    <style>
        @media screen and (min-width: 600px) {
            .input-grid-area {
                grid-area: 1 / 1 / span 3 / span 2;
            }
        }
    </style>
    <div class="grid grid-cols-3 gap-3  ">
        <section class="bg-white rounded-md w-full p-3 min-h-full shadow-1 input-grid-area">
            <section class="flex justify-between items-center">
                <p>Tanggal: <time id="transaction-date"></time></p>
                <p>Kasir: {{ Auth::user()->name }}</p>
            </section>
            <select id="supplier-select" name="brand_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2"
                required>
                <option selected disabled>Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            <input type="text" id="barcode-input"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2"
                placeholder="Barcode">
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
                        @foreach ($purchase_order->items ?? [] as $item)
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
                                    <button class="material-icons hover:bg-gray-100 rounded-full p-[2px] cursor-pointer">shopping_basket</button>
                                    <button class="material-icons hover:bg-gray-100 rounded-full p-[2px] cursor-pointer">delete</button>
                                    <x-modal.input method="POST" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <section class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
            <h1 class="text-4xl font-semibold text-end">90000</h1>
        </section>
        <section id="select-product" class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
            <form>
                <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2" placeholder="Search product...">
            </form>
            <div class="mt-2 grid grid-cols-3">
                @foreach ($products as $product)
                    <form class="max-w-[105px] cursor-pointer" method="POST" action="/transaction/purchase-order?action=set_items">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <div class="w-[105px] h-[105px]">
                            <img src="/storage/product/{{ $product->image?->name }}" class="object-cover w-full h-full" />
                        </div>
                        <p class="truncate">{{ $product->name }}</p>
                        <div class="flex items-center mt-1 justify-evenly">
                            <button type="button" class="h-5 w-5 bg-red-600">-</button>
                            <input type="number" name="quantity" value="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-7 h-6 p-0.5 text-end" required>
                            <button type="button">+</button>
                        </div>
                        <button type="submit" class="bg-green-400 py-[1px] w-full rounded text-green-800 mt-1">Add</button>
                    </form>
                @endforeach
            </div>
        </section>
    </div>
@endsection
