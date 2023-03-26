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
        <ul class="space-y-2 mt-5 font-medium">
            <li>
                <div id="button" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 duration-300">
                    <span class="material-icons sidebar">home</span>
                    <span class="ml-3">Dashboard</span>
                </div>
                <div class="overflow-hidden duration-[0.2s] ease-out max-h-0">
                    Javascript is
                </div>
            </li>
        </ul>
    </aside>
    <main>
        @yield('main')
    </main>
</body>
<script>
    const accordion = document.getElementById('button')
    // const hoho = document.getElementById('panel')

    accordion.addEventListener('click', function(e) {
        const panel = this.nextElementSibling;

        // hoho.classList.remove('hidden')
        // hoho.classList.add('block')
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    })
</script>
</html>
