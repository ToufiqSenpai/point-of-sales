@extends('layouts.dashboard')

@section('title', 'invoice')

@section('main')
  <div class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
    <header>
      <h1>{Nama toko} - Invoice</h1>
      <p>Date: <time datetime="{{ $purchase_order->created_at->toIso8601String() }}"></time></p>
    </header>
  </div>
@endsection