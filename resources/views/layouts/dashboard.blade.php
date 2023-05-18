<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/ts/script/dashboard.ts', 'resources/ts/script/components/index.ts'])
</head>

<body>
    <aside
        class="fixed top-0 left-0 bottom-0 w-[240px] h-screen bg-white border-r border-solid border-[rgba(0, 0, 0, 0.12)] p-3 overflow-y-auto">
        <div class="flex items-center">
            <img src="/__test__/rice.png" width="50" />
            <h1 class="text-xl font-semibold ml-2">POINT OF SALES</h1>
        </div>
        <ul class="space-y-1 mt-5 font-medium text-gray-500">
            <li>
                <a href="/home" id="button"
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 accordion-sidebar">
                    <span class="material-icons sidebar">home</span>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <button class="flex items-center p-2 rounded-lg hover:bg-gray-100 duration-300 accordion-sidebar w-full">
                    <span class="material-icons sidebar">point_of_sale</span>
                    <span class="ml-3">Transaksi</span>
                </button>
                <ul class="space-y-1 max-h-0 overflow-hidden duration-300 mt-1  ">
                    <li>
                        <a href="/transaction/purchase-order"
                            class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    <li>
                        <a href="/transaction/history" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>History</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button class="flex items-center p-2 rounded-lg hover:bg-gray-100 duration-300 accordion-sidebar w-full">
                    <span class="material-icons sidebar">groups</span>
                    <span class="ml-3">Customer</span>
                </button>
                <ul class="space-y-1 max-h-0 overflow-hidden duration-300 mt-1  ">
                    <li>
                        <a href="/customer" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>List</p>
                        </a>
                    </li>
                    <li>
                        <a href="/customer/add" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Tambah Customer</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 duration-300 accordion-sidebar w-full">
                    <span class="material-icons sidebar">local_shipping</span>
                    <span class="ml-3">Supplier</span>
                </button>
                <ul class="space-y-1 max-h-0 overflow-hidden duration-300 mt-1  ">
                    <li>
                        <a href="/supplier" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>List</p>
                        </a>
                    </li>
                    <li>
                        <a href="/supplier/add" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Tambah Supplier</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 duration-300 accordion-sidebar w-full">
                    <span class="material-icons sidebar">inventory_2</span>
                    <span class="ml-3">Product</span>
                </button>
                <ul class="space-y-1 max-h-0 overflow-hidden duration-300 mt-1  ">
                    <li>
                        <a href="/product" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>List Product</p>
                        </a>
                    </li>
                    <li>
                        <a href="/product/brand" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Brand</p>
                        </a>
                    </li>
                    <li>
                        <a href="/product/category" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Category</p>
                        </a>
                    </li>
                    <li>
                        <a href="/product/unit" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Unit</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button
                    class="flex items-center p-2 rounded-lg hover:bg-gray-100 duration-300 accordion-sidebar w-full">
                    <span class="material-icons sidebar">person</span>
                    <span class="ml-3">User</span>
                </button>
                <ul class="space-y-1 max-h-0 overflow-hidden duration-300 mt-1  ">
                    <li>
                        <a href="/user" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>List</p>
                        </a>
                    </li>
                    <li>
                        <a href="/user/create" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Tambah User</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    <nav
        class="fixed top-0 right-0 w-full max-w-[calc(100%-240px)] h-11 bg-white border-b border-solid border-[rgba(0, 0, 0, 0.12)] px-4 flex items-center">
        <h2 class="font-medium text-xl">@yield('title')</h2>
    </nav>
    <main class="w-full max-w-[calc(100%-240px)] mt-14 ml-auto max-ipad:px-4 min-ipad:px-8 relative">
        @if (session()->has('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        @if (session()->has('error'))
            <x-alert type="error">{{ session('error') }}</x-alert>
        @endif
        @if(session()->has('error_list'))
            <x-alert-list type="error" errors="{{ session('error_list') }}" />
        @endif
        @yield('main')
    </main>
</body>

</html>
