@extends('layouts.dashboard')

@section('title', 'Purchase Order')

@section('main')
    <style>
        @media screen and (min-width: 600px) {
            .input-grid-area {
                grid-area: 1 / 1 / span 3 / span 2;
            }
        }
    </style>
    <div class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
        <section class="flex justify-between items-center">
            <p>Tanggal: <time></time></p>
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
        <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama *</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required>
        @error('name')
            <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
    </div>
@endsection
