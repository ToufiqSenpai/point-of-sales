@extends('layouts.dashboard')

@section('title', 'Tambah Produk')

@section('main')
    <style>
        @media screen and (min-width: 600px) {
            .input-grid-area {
                grid-area: 1 / 1 / span 3 / span 2;
            }
        }
    </style>
    <form class="grid grid-cols-3 max-ipad:grid-cols-1 gap-5" action="/product/add" method="post" enctype="multipart/form-data">
        @csrf
        <section class="bg-white shadow-1 p-3 h-min input-grid-area">
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mt-2">
                <label for="barcode" class="block mb-1 text-sm font-medium text-gray-900">Barcode</label>
                <input type="text" id="barcode" name="barcode" value="{{ old('barcode') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mt-2">
                <label for="sku" class="block mb-1 text-sm font-medium text-gray-900">SKU</label>
                <input type="text" id="sku" name="sku" value="{{ old('sku') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mt-2">
                <label for="description" class="block mb-1 text-sm font-medium text-gray-900">Deskripsi</label>
                <textarea id="description" name="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            </div>
            <div class="mt-2 flex items-end">
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Foto</label>
                    <div class="relative">
                        <span class="z-10 absolute top-[2px] right-[2px] rounded-full text-white bg-[rgba(55,65,81,0.8)] flex justify-between items-center cursor-pointer">
                        </span>
                            <label class="relative border border-dashed border-slate-800 rounded-md w-[120px] h-[120px] flex justify-between items-center">
                                <input type="file" name="image" hidden />
                            </label>
                        </div>
                    </div>
                <p class="ml-2">Drop your image here, or <span class="text-indigo-600">browse.</span></p>
            </div>
        </section>
        <section class="bg-white shadow-1 p-3 h-min">
            <div>
                <label for="brand" class="block mb-1 text-sm font-medium text-gray-900">Brand *</label>
                <select id="brand" name="brand_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option selected disabled>None</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand['id'] }}" {{ old('brand') == $brand['id'] ? 'selected' : '' }}>{{ $brand['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label for="category" class="block mb-1 text-sm font-medium text-gray-900">Kategori *</label>
                <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option selected disabled>None</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category') == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label for="unit" class="block mb-1 text-sm font-medium text-gray-900">Unit *</label>
                <select id="unit" name="unit_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option selected disabled>None</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit['id'] }}" {{ old('unit') == $unit['id'] ? 'selected' : '' }}>{{ $unit['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </section>
        <section class="bg-white shadow-1 p-3 h-min">
            <div>
                <label for="base_price" class="block mb-1 text-sm font-medium text-gray-900">Harga Dasar *</label>
                <input type="number" id="base_price" name="base_price" value="{{ old('base_price') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
            </div>
            <div class="mt-2">
                <label for="selling_price" class="block mb-1 text-sm font-medium text-gray-900">Harga Jual *</label>
                <input type="number" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
            </div>
        </section>
        <button type="submit">SUBMIT</button>
    </form>
@endsection
