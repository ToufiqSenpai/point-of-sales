@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('main')
    <form class="bg-white rounded-md p-3 grid grid-cols-2 max-ipad:grid-cols-1 gap-2 shadow-1" action="/user/edit" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user['id'] }}" />
        <div>
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Nama *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user['name']) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('name')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username *</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user['username']) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('username')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role *</label>
                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="OWNER" @if($user['role'] == 'OWNER') selected @endif>OWNER</option>
                    <option value="ADMIN" @if($user['role'] == 'ADMIN') selected @endif>ADMIN</option>
                    <option value="CASHIER" @if($user['role'] == 'CASHIER') selected @endif>CASHIER</option>
                </select>
            </div>
        </div>
        <div>
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user['email']) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('email')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-2">
                <label for="phone" class="block mb-1 text-sm font-medium text-gray-900">Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user['phone']) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('phone')
                <p class="mt-0.5 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class='flex justify-end my-1'>
                <a href='/user/change-password/{{ $user['id'] }}' class='text-sm text-blue-400 cursor-pointer no-underline hover:underline'>Lupa password?</a>
            </div>
            <button type="submit" class="bg-green-500 py-1 w-full rounded-md text-white text-lg font-medium mt-2">SUBMIT</button>
        </div>
    </form>
@endsection
