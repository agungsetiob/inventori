@extends('layouts.main')

@section('container')
<div class="container px-4">
    <div class="bg-white p-5 mt-5 rounded-lg">
        <div class="flex">
            <h2 class="text-gray-600 font-bold">Input Data Petugas</h2>
        </div>

        <form action="/input-petugas" method="POST" class="w-full md:w-1/2 mt-5">
            @csrf
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="name">Nama Petugas</label>
                <div class="border-2 p-1 @error('name')  border-red-400  @enderror">
                    <input autocomplete="off" name="name" value="{{old('name')}}" class="w-full h-full focus:outline-none text-sm" id="name" type="text">
                </div>
                @error('name')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="email">Email Petugas</label>
                <div class="@error('email')  border-red-400  @enderror border-2 p-1">
                    <input autocomplete="off" type="email" value="{{old('email')}}"  name="email" class="text-sm w-full h-full focus:outline-none" id="email" type="text">
                </div>
                @error('email')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="password">Password Petugas</label>
                <div class="@error('password')  border-red-400  @enderror border-2 p-1">
                    <input autocomplete="off" type="password" value="{{old('password')}}"  name="password" class="text-sm w-full h-full focus:outline-none" id="password" type="text">
                </div>
                 @error('password')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <button class="bg-gradient-to-r from-gray-600 to-gray-700 text-white w-full p-2 text-sm hover:from-indigo-500 hover:via-cyan-500 hover:to-sky-500 text-white mt-2 md:mt-0 md:mr-2 px-4 py-2 min-w-max flex-shrink-0 transition-colors duration-300">
                    Simpan Data
                </button>
            </div>
    </form>
    </div>
</div>
@endsection

