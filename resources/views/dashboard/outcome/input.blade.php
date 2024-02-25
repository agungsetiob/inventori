@extends('layouts.main')

@section('container')
<div class="container px-4">
    <div class="bg-white p-5 mt-5 rounded-lg">
        <div class="flex">
            @if(Auth::user()->role === 'admin')
            <h2 class="text-gray-600 font-bold">Input Data Barang Keluar</h2>
            @elseif(Auth::user()->role === 'officer')
            <h2 class="text-gray-600 font-bold">Input Data Barang</h2>
            @endif
        </div>

        <form action="/input-barang-keluar" method="POST" class="w-full md:w-1/2 mt-5">
            @csrf
            <div class="flex gap-1 mt-3">
                <div class="w-full">
                    <label class="text-sm text-gray-600"  for="name">Nama Barang</label>
                    <div class="border-2 @error('product') border-red-400 @enderror">
                        {{-- select with choice js --}}
                        <select name="product" class="select-product text-black" id="">
                        </select>
                    </div>
                    @error('product')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>
            {{--<div class="flex gap-1 mt-3">
                <div class="w-full">
                    <label class="text-sm text-gray-600"  for="category">Nama Supplier</label>
                    <div class="border">
                        <select name="supplier_id" class="select-supplier text-black" id="">
                        </select>
                    </div>
                </div>
            </div>--}}
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="quantity">Jumlah</label>
                <div class="@error('quantity')  border-red-400  @enderror border-2 p-1">
                    <input name="quantity" autocomplete="off" class="text-sm text-black w-full h-full focus:outline-none" id="quantity" type="number">
                </div>
                @error('quantity')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="date">Tanggal</label>
                <div class="@error('date')  border-red-400  @enderror border-2 p-1">
                    <input type="date" name="date" class="text-sm text-black w-full h-full focus:outline-none" id="date" type="text">
                </div>
                 @error('date')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <button class="bg-gradient-to-r from-gray-600 to-gray-700 text-white w-full p-2 text-sm hover:from-indigo-500 hover:via-cyan-500 hover:to-sky-500 text-white mt-2 md:mt-0 md:mr-2 px-4 py-2 min-w-max flex-shrink-0 transition-colors duration-300">
                    Simpan Data
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/supplies/input.js') }}"></script>
@endsection