<div class="fixed top-0 left-0 right-0 bottom-0 z-40 duration-300" style="background-color: rgba(0,0,0,0); visibility: hidden">
    <form action="{{ $action }}" method="POST" class="w-full h28 max-w-md max-mobile:max-w-[94%] bg-white rounded-md px-6 py-5 text-center absolute top-[50%] left-[50%] duration-300 opacity-0" style="transform: translate(-50%,-30%)">
        @method('delete')
        @csrf
        <input type="hidden" name="id" value="{{ $id }}" />
        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h3 class="mb-5 text-lg font-normal text-gray-500">{{ $description }}</h3>
        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 btn-cancel">Tidak</button>
        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
            Ya
        </button>
    </form>
</div>
