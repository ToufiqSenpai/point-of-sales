@extends('layouts.dashboard')

@section('title', 'Purchase Order')

@section('main')
    {{-- @vite('resources\ts\script\transaction\purchase-order\index.ts') --}}
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
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
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
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Apple MacBook Pro 17"
                            </th>
                            <td class="px-6 py-4">
                                Silver
                            </td>
                            <td class="px-6 py-4">
                                <a href="/product">fwe</a>
                            </td>
                            <td class="px-6 py-4">
                                Laptop
                            </td>
                            <td class="px-6 py-4 table-option-dropdown">
                                <span class="material-icons hover:bg-gray-100 rounded-full p-[2px] cursor-pointer">more_vert</span>
                                <div class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 fixed option-dropdown" style="display: none">
                                    <ul class="py-2 text-sm text-gray-700">
                                      <li>
                                        <span class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Quantity</span>
                                      </li>
                                      <li>
                                        <span class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Discount</span>
                                      </li>
                                      <li>
                                        <span class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Delete</span>
                                      </li>
                                    </ul>
                                </div>
                                <x-modal.input title="Quantity" type="number" />
                                <x-modal.input title="Discount" type="number" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
            <h1 class="text-4xl font-semibold text-end">90000</h1>
        </section>
        <section id="select-product" class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
            <input type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2"
                placeholder="Search product...">
            <div class="mt-2 grid grid-cols-3">
                @foreach ($products as $product)
                    <figure class="max-w-[105px] cursor-pointer">
                        <div class="w-[105px] h-[105px]">
                            <img src="/storage/product/5a95ff23-668d-45e2-a05e-f025f9c480ce.jpg" class="object-cover w-full h-full" />
                        </div>
                        <div class="flex items-center mt-1 justify-evenly">
                            <button class="h-5 w-5 bg-red-600">-</button>
                            <input type="number" name="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-7 h-6 p-0.5 text-end">
                            <button>+</button>
                            <x-form.transaction-id />
                        </div>
                        <figcaption class="truncate">OFfwefwfwefwefwfwef</figcaption>
                    </figure>
                @endforeach
            </div>
        </section>
    </div>
@endsection
