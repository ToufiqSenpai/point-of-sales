@extends('layouts.dashboard')

@section('title', 'Edit Unit Produk')

@section('main')
    <form class="bg-white rounded-md p-3 shadow-1" action="/product/unit/edit" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{ $unit['id'] }}" />
        <div class="max-w-lg px-4 mx-auto">
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $unit['name']) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('name')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="description" class="block mb-1 text-sm font-medium text-gray-900">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $unit['description']) }}</textarea>
                @error('description')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-green-500 py-1 w-full rounded-md text-white text-lg font-medium mt-2">SUBMIT</button>
        </div>
    </form>
@endsection
