@extends('layouts.main')

@section('container')

@if (session('message'))
   <div id="toast-container" class="hidden fixed z-50 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded border-l-2 border-green-400 shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
    <div class=" text-green-400 text-sm font-bold capitalize">{{session()->get('message')}}</div>
</div>
@endif
    <div class="container px-4">
    <h2 class="text-gray-900 font-bold">Data Barang Masuk</h2>
        <div class="bg-white mt-5 p-5 rounded-lg overflow-x-auto">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="text-left mb-4 md:mb-0">
                    @if(Auth::user()->role === 'admin')
                    <a href="/input-barang-masuk" class="text-sm inline-block bg-gray-700 
                    hover:bg-gradient-to-r hover:from-indigo-500 hover:via-cyan-500 
                    hover:to-sky-500 text-white mt-2 md:mt-0 md:mr-2 px-2 py-2 
                    min-w-max flex-shrink-0 transition-colors duration-300"><i class="ri-add-fill"></i> Input Barang Masuk</a>
                    @endif
                </div>
                <form method="get" action="/barang-masuk" class="form">
                    <div class="flex">
                        <div class="border p-1 px-2 rounded-l">
                          <input id="search" name="search" class="focus:outline-none text-sm" type="text" placeholder="search">
                        </div>
                        <button type="submit" class="text-sm bg-gray-700 p-2 md:p-2 rounded-r text-white h-full md:h-auto">cari</button>
                    </div>
                </form>
            </div>

            <table class="w-full mt-5 text-sm text-gray-600 table-auto">
                <thead>
                    <tr class="font-bold border-b-2 p-2">
                        <td class="p-2">No</td>
                        <td class="p-2">Nama Barang</td>
                        <td class="p-2">Nama Admin</td>
                        <td class="p-2">Nama Supplier</td>
                        <td class="p-2">Jumlah Barang Masuk</td>
                        <td class="p-2">Tanggal</td>
                        @if(Auth::user()->role === 'admin')
                        <td class="p-2">Aksi</td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsIncome as $productIncome)
                    <tr class="border-b-2 p-2 hover:bg-gray-100">
                        <td class="p-2">{{$loop->iteration}}</td>
                        <td class="p-2">{{$productIncome->product->name}}</td>
                        <td class="p-2">{{$productIncome->user->name}}</td>
                        <td class="p-2">{{$productIncome->supplier->name}}</td>
                        <td class="p-2">{{$productIncome->quantity}}</td>
                        <td class="p-2">{{$productIncome->date}}</td>
                        @if(Auth::user()->role === 'admin')
                        <td class="p-2 flex gap-2">
                            <button data-id="{{$productIncome->id}}" class="btn-delete-product-income bg-red-500 py-1 px-4 rounded text-white">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            <a href="/ubah-barang-masuk/{{$productIncome->id}}" class="bg-yellow-400 py-1 px-4 rounded text-white">
                                <i class="ri-edit-box-line"></i>
                            </a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{$productsIncome->links('pagination::tailwind')}}
            </div>
        </div>
    </div>
@endsection