@extends('layouts.dashboard')

@section('title', 'Tambah Supplier')

@section('main')
    <form class="grid grid-cols-2 max-ipad:grid-cols-1 gap-3" action="/supplier/add" method="POST">
        @csrf
        <div class="bg-white rounded-md p-3 shadow-1 h-max">
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('name')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="username" class="block mb-1 text-sm font-medium text-gray-900">No.Telepon *</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('username')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('password')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="bg-white rounded-md p-3 shadow-1">
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat *</label>
                <textarea id="address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('address') }}</textarea>
                @error('address')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-green-500 py-1 w-full rounded-md text-white text-lg font-medium mt-2">SUBMIT</button>
        </div>
    </form>
@endsection
