<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
</head>
<body>
    <aside class="fixed top-0 left-0 bottom-0 w-[240px] h-screen bg-white border border-solid border-[rgba(0, 0, 0, 0.12)] p-3 overflow-y-auto">
        <div class="flex items-center">
            <img src="/__test__/rice.png" width="50" />
            <h1 class="text-xl font-semibold ml-2">POINT OF SALES</h1>
        </div>
        <ul class="space-y-1 mt-5 font-medium text-gray-500">
            <li>
                <a href="/home" id="button" class="flex items-center p-2 rounded-lg hover:bg-gray-100 accordion-sidebar">
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
                        <a href="/transaction" class="p-1 hover:bg-gray-100 flex items-center rounded-lg">
                            <span class="w-1 h-1 bg-black rounded-full ml-4 mr-6"></span>
                            <p>Buat Transaksi</p>
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
        </ul>
    </aside>
    <nav>

    </nav>
    <main>
        @yield('main')
    </main>
</body>
<script>
    // const accordion = document.getElementById('button')
    // // const hoho = document.getElementById('panel')
    //
    // accordion.addEventListener('click', function(e) {
    //     e.preventDefault()
    //     const panel = this.nextElementSibling;
    //
    //     // hoho.classList.remove('hidden')
    //     // hoho.classList.add('block')
    //     if (panel.style.maxHeight) {
    //         panel.style.maxHeight = null;
    //     } else {
    //         panel.style.maxHeight = panel.scrollHeight + "px";
    //     }
    // })
</script>
</html>
