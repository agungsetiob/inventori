@extends('layouts.main')

@section('container')

@if (session('message'))
   <div id="toast-container" class="hidden fixed z-50 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded border-l-2 border-green-400 shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
    <div class=" text-green-400 text-sm font-bold capitalize">{{session()->get('message')}}</div>
</div>
@elseif (session('error'))
   <div id="toast-container" class="hidden fixed z-50 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded border-l-2 border-red-400 shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
    <div class=" text-red-400 text-sm font-bold capitalize">{{session()->get('error')}}</div>
</div>
@endif
    <div class="container px-4">
        <div class="bg-white mt-5 p-5 rounded-lg">
            <div class="flex justify-between">
                <div class="text-left">
                    <h2 class="text-gray-600 font-bold">Data Permintaan Barang</h2>
                    @if(Auth::user()->role === 'admin')
                    <a href="/input-barang-keluar" class="text-sm bg-gray-700 text-white text-center block mt-2 px-2 py-1"><i class="ri-add-fill"></i> Input Barang Keluar</a>
                    @elseif(Auth::user()->role === 'officer')
                    <a href="/input-barang-keluar" class="text-sm bg-gray-700 text-white text-center block mt-2 px-2 py-1"><i class="ri-add-fill"></i> Input Barang</a>
                    @endif
                </div>
                <form method="get" action="/barang-keluar/" class="form">
                    <div class="flex">
                        <div class="border p-1 px-2 rounded-l">
                          <input id="search" name="search" class="focus:outline-none text-sm" type="text" placeholder="search">
                        </div>
                        <button type="submit" class="text-sm bg-gray-700 p-2 rounded-r text-white h-full">cari</button>
                    </div>
                </form>
            </div>

            <table class="w-full mt-5 text-sm text-gray-600">
                <thead>
                    <tr class="font-bold border-b-2 p-2">
                        <td class="p-2">No</td>
                        <td class="p-2">Nama Barang</td>
                        <td class="p-2">Nama</td>
                        {{-- <td class="p-2">Nama Supplier</td> --}}
                        <td class="p-2">Jumlah</td>
                        <td class="p-2">Tanggal</td>
                        <td class="p-2">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsOutcome as $productOutcome)
                    <tr class="border-b-2 p-2">
                        <td class="p-2">{{$loop->iteration}}</td>
                        <td class="p-2">{{$productOutcome->product->name}}</td>
                        <td class="p-2">{{$productOutcome->user->name}}</td>
                        {{--<td class="p-2">{{$productOutcome->supplier->name}}</td>--}}
                        <td class="p-2">{{$productOutcome->quantity}}</td>
                        <td class="p-2">{{$productOutcome->date}}</td>
                        <td class="p-2 flex gap-2">
                            @if($productOutcome->status == 'pending')
                            <button data-id="{{$productOutcome->id}}" class="btn-delete-product-outcome bg-red-500 py-1 px-4 rounded text-white">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            <a href="/ubah-barang-keluar/{{$productOutcome->id}}" class="bg-yellow-400 py-1 px-4 rounded text-white">
                                <i class="ri-edit-box-line"></i>
                            </a>
                            @endif
                            @if(Auth::user()->role === 'admin' && $productOutcome->status === 'pending')
                            <form action="/approve/{{$productOutcome->id}}" method="post">
                                @csrf
                                @method('patch')
                                <button type="submit" class="bg-green-400 py-1 px-4 rounded text-white">
                                    <i class="ri-check-line"></i> Approve
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{$productsOutcome->links('pagination::tailwind')}}
            </div>
        </div>
    </div>
@endsection