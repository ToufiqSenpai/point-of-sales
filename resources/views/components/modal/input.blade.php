<div class="fixed top-0 left-0 right-0 bottom-0 z-40 duration-300" style="background-color: rgba(0,0,0,0); visibility: hidden">
  <div class="w-full h28 max-w-md max-mobile:max-w-[94%] bg-white rounded-md absolute top-[50%] left-[50%] duration-300 opacity-0" style="transform: translate(-50%,-30%)">
    <h3 class="text-xl font-medium text-gray-900 dark:text-white px-6 py-4">{{ $title }}</h3>
    <div class="relative px-6 pb-4">
      <input type="{{ $type }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
      <label class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"></label>
    </div>
    <div class="flex items-center p-2 justify-end text-blue-500 font-medium">
      <button class="btn-cancel inline-flex py-[6px] px-2">CANCEL</button>
      <button class="btn-ok inline-flex py-[6px] px-2">OK</button>
    </div>
  </div>
</div>