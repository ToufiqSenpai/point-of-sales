@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('main')
    <form class="bg-white rounded-md p-3 grid grid-cols-2 max-ipad:grid-cols-1 gap-2 shadow-1" action="/user/create" method="POST">
        @csrf
        <div>
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                @error('name')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username *</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('username')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password *</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('password')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('email')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="phone" class="block mb-1 text-sm font-medium text-gray-900">Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('phone')
                    <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-green-500 py-1 w-full rounded-md text-white text-lg font-medium mt-2">SUBMIT</button>
        </div>
    </form>
@endsection
