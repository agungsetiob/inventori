<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
   <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   @vite('resources/css/app.css')
   <title>Dashboard Inventory</title>
   <link rel="icon" type="image/x-icon" href="{{url('img/invent.png')}}">
</head>

<body class="text-black">

   {{-- sidebar start --}}
   <div id="sidebar" class="w-64 bg-gradient-to-b from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% h-full p-4 fixed top-0 left-0">
      <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
         <img src="{{url('img/invent.png')}}" alt="logo" class="w-8 h-8 rounded mr-2 object-cover" />
         <span class="text-lg font-bold text-white">Inventori RSUD</span>
      </a>
      <ul class="mt-4">
         <li class="mb-1 group">
            <a href="/" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-dashboard-3-line mr-3 text-lg"></i>
               <span class="text-sm">Overview</span>
            </a>
         </li>

         <li class="mb-1 group">
            <a href="/barang" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-archive-2-line mr-3 text-lg"></i>
               <span class="text-sm">Data Barang</span>
            </a>
         </li>
         <li class="mb-1 group">
            <a href="/supplier" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-truck-line mr-3 text-lg"></i>
               <span class="text-sm">Data Supplier</span>
            </a>
         </li>
         <li class="mb-1 group">
            <a href="/kategori" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-store-line mr-3 text-lg"></i>
               <span class="text-sm">Data Kategori</span>
            </a>
         </li>
         <li class="mb-1 mt-5 group">
            <a href="/barang-masuk" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-file-add-fill mr-3 text-lg"></i>
               <span class="text-sm">Barang Masuk</span>
            </a>
         </li>

         <li class="mb-1 group">
            <a href="/barang-permintaan" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-folder-transfer-line mr-3 text-lg"></i>
               <span class="text-sm">Permintaan Barang</span>
            </a>
         </li>
         <li class="mb-1 group">
            <a href="/approved" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-folder-reduce-fill mr-3 text-lg"></i>
               <span class="text-sm">Barang Keluar</span>
            </a>
         </li>

         @if(Auth::user()->role === 'admin')
         <li class="mb-1 mt-5 group">
            <a href="/petugas" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-user-line mr-3 text-lg"></i>
               <span class="text-sm">Data Akun</span>
            </a>
         </li>

         <li class="mb-1 group">
            <a href="/admin" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-admin-line mr-3 text-lg"></i>
               <span class="text-sm">Data Admin</span>
            </a>
         </li>
         @endif

         <li class="mb-1 group mt-5">
            <a href="/logout" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-900 rounded-lg">
               <i class="ri-logout-circle-line text-lg mr-3"></i>
               <span class="text-sm">Logout</span>
            </a>
         </li>
      </ul>
   </div>
   {{-- sidebar end --}}
      <main class="md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 flex-grow min-h-screen"
         style="background-image: url('img/octagon.png'); background-size: cover; background-position: center;">
         {{-- navbar start --}}
         <div
            class="bg-gradient-to-r from-indigo-500 from-15% via-sky-500 via-30% to-emerald-500 to-90% py-2 px-4 flex items-center justify-between shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button id="sidebarToggle" class="md:hidden text-gray-900 focus:outline-none">
               <i class="ri-menu-line text-xl"></i>
            </button>
            <ul class="flex items-center text-sm hidden lg:block">
               <li class="mr-2">
                  <a href="#" class="text-gray-500 hover:text-gray-600 font-medium" hidden>Dashboard</a>
               </li>
            </ul>
            <div class="mr-2 flex items-center">
               <p class="text-sm text-gray-600">{{Auth::user()->name}}</p>
               <img src="https://rsud.tanahbumbukab.go.id/storage/logors.png" alt="logo"
                  class="w-8 h-8 rounded-full ml-2 object-cover" />
            </div>
         </div>
         {{-- navbar end --}}

         {{-- main content --}}
         @yield('container')
         {{-- main content end --}}

         <footer class="sticky top-[100vh] pb-2">
            <p class="text-sm text-center">© Agung Setio Budi 2024</p>
         </footer>
      </main>
   <script src="{{ asset('js/index.js') }}"></script>
   @yield('js')
</body>
<script>
  const sidebar = document.getElementById('sidebar');
  const mobileSidebarToggle = document.getElementById('sidebarToggle');

  mobileSidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
  });

  const mediaQuery = window.matchMedia('(max-width: 768px)');

  function handleMobileSidebar(mediaQuery) {
    if (mediaQuery.matches) {
      sidebar.classList.add('hidden');
    } else {
      sidebar.classList.remove('hidden');
    }
  }
  handleMobileSidebar(mediaQuery);
  mediaQuery.addListener(handleMobileSidebar);
</script>
</html>