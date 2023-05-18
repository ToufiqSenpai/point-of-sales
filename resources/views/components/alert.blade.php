@switch($type)
    @case('success')
        <div id="alert" class="flex p-4 mb-4 text-sm text-slate-800 rounded-lg bg-green-50 fixed left-0 right-0 min-w-[360px] max-w-[560px] mx-auto duration-500 z-50" role="alert" style="top: -8%">
            <span class="flex-shrink-0 inline w-5 h-5 mr-5 material-icons text-green-500">
                task_alt
            </span>
            <div>
                {{ $slot }}
            </div>
        </div>
        @break
    @case('error')
        <div id="alert" class="flex p-4 mb-4 text-sm text-slate-800 rounded-lg bg-red-50 fixed left-0 right-0 min-w-[360px] max-w-[560px] mx-auto duration-500 z-50" role="alert" style="top: -8%">
            <span class="flex-shrink-0 inline w-5 h-5 mr-5 material-icons text-red-500">
                error
            </span>
            <div>
                {{ $slot }}
            </div>
        </div>
        @break
    @default
    <h1>No Alert</h1>
@endswitch
