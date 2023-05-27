@extends('layouts.dashboard')

@section('title', 'Settings')
@section('main')
  @vite('resources/ts/script/settings/index.ts')
  <form class="bg-white rounded-md w-full p-3 min-h-full shadow-1" autocomplete="off">
    @csrf
    @method('PUT')
    <div>
      <div class="w-[140px] h-[140px] overflow-hidden">
        <img id="shop_image" src="/storage/icons/shop.png" class="object-cover w-full" />
      </div>
      <label class="bg-green-500 text-green-900 px-3 rounded cursor-pointer font-medium">
        CHANGE IMAGE
        <input id="input-file" type="file" name="shop_image" accept=".jpg,.jpeg,.png" hidden />
      </label>
    </div>
    <div class="mt-2">
      <label for="name" class="block mb-1 text-sm font-medium text-gray-900">Shop Name</label>
      <input type="text" id="name" name="name" value="{{ $shop->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mt-2">
      <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
      <input type="email" id="email" name="email" value="{{ $shop->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mt-2">
      <label for="phone" class="block mb-1 text-sm font-medium text-gray-900">Phone</label>
      <input type="number" id="phone" name="phone" value="{{ $shop->phone }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>
    <div class="mt-2">
      <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
      <textarea id="address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $shop->address }}</textarea>
    </div>
    <div class="mt-2">
      <label for="invoice_footer" class="block mb-2 text-sm font-medium text-gray-900">Invoice Footer</label>
      <textarea id="invoice_footer" name="invoice_footer" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $shop->invoice_footer }}</textarea>
    </div>
    <button type="submit" class="bg-green-500 text-black rounded w-20 mt-2">SAVE</button>
  </form>
@endsection