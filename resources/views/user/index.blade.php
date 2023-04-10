@extends('layouts.dashboard')

@section('title', 'User List')

@section('main')
    <div class="bg-white rounded-md w-full p-3 min-h-full shadow-1">
        @if(session()->has('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        <div class="flex justify-end">
            <a href="/user/add" class="bg-green-500 text-white px-3 py-1 rounded-md font-medium ml-auto">Tambah User</a>
        </div>
        <form class="flex items-center mt-3">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search user..." required>
            </div>
            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-green-500 rounded-lg border border-green-700 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="sr-only">Search</span>
            </button>
        </form>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No. Telepon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $user)
                       <tr class="@if($loop->index % 2 == 0) bg-white @else bg-gray-50 @endif border-b dark:bg-gray-900 dark:border-gray-700">
                           <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{ $user['name'] }}
                           </th>
                           <td class="px-6 py-4">
                               {{ $user['username'] }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $user['email'] }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $user['phone'] }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $user['role'] }}
                           </td>
                           <td class="px-6 py-4">
                               <a href="/user/edit/{{ $user['id'] }}" class="text-sm hover:underline">
                                   <span class="material-icons table-action bg-blue-500 p-1 rounded text-white">edit</span>
                               </a>
                               <button class="text-sm hover:underline table-delete-btn">
                                   <span class="material-icons table-action bg-red-500 p-1 rounded text-white">delete</span>
                               </button>
                               <x-modal.delete description="Apakah anda ingin menghapus {{ $user['name'] }}" action="/user" id="{{ $user['id'] }}" />
                           </td>
                       </tr>
                   @endforeach
                </tbody>
            </table>
            <nav class="flex items-center justify-between py-4 px-6" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</span></span>
                <div class="flex gap-4">
                    <a href="{{ $users->previousPageUrl() }}">
                        <span class="material-icons cursor-pointer">navigate_before</span>
                    </a>
                    <a href="{{ $users->nextPageUrl() }}">
                        <span class="material-icons cursor-pointer">navigate_next</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>
@endsection
