@extends('layouts.main')

@section('container')
<div class="container px-4">
    <div class="bg-white p-5 mt-5 rounded-lg">
        <div class="flex">
            <h2 class="text-gray-600 font-bold">Input Data Barang</h2>
        </div>

        <form class="w-full md:w-1/2 mt-5" action="/input-barang" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="name">Nama Barang</label>
                <div class="border-2 p-1 @error('name')  border-red-400  @enderror">
                    <input name="name" value="{{old('name')}}" class="text-black w-full h-full focus:outline-none text-sm" id="name" type="text">
                </div>
                @error('name')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="price">Harga Barang</label>
                <div class="@error('price')  border-red-400  @enderror border-2 p-1">
                    <input value="{{old('price')}}"  name="price" class="text-black text-sm w-full h-full focus:outline-none" id="price" type="number">
                </div>
                @error('price')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            {{--<div class="mt-3">
                <label class="text-sm text-gray-600" for="image">Gambar Barang</label>
                <div class="@error('image')  border-red-400  @enderror border-2 p-1">
                    <input type="file" name="image" class="text-sm w-full h-full focus:outline-none" id="image" type="text">
                </div>
                 @error('image')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>--}}
            <div class="flex gap-1 mt-3">
                <div class="w-full">
                    <label class="text-sm text-gray-600"  for="category">Kategori Barang</label>
                    <div class="border-2 @error('category_id')  border-red-400  @enderror">
                        <select name="category" class="w-full text-black p-2 text-sm bg-transparent focus:outline-none" name="" id="">
                            <option value="" disabled selected>Pilih kategori</option>    
                            @foreach($categories as $category)
                            <option class="text-sm" value="{{$category->id}}" @selected( old('category_id') == $category->id)>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
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

