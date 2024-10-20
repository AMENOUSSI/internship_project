@extends('layouts.template')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6 dark:text-white">Enregistrer une categorie</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category_people.store') }}" method="POST" class="bg-white p-6 rounded shadow-md dark:bg-black dark:shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2 dark:text-white">Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg p-2" >
            </div>
            {{--<div class="">
                <label for="pays">Pays</label>
                <select name="pays" id="pays" class="w-full border-gray-300 rounded-lg p-2">
                    <option value="">Sélectionnez un pays</option>
                    @foreach($pays as $p)
                        <option value="{{ $p['name'] }}" class="">{{ $p['name'] }} - {{ $p['code'] }}</option>
                    @endforeach
                </select>
            </div>--}}


            <div class="flex justify-end">
                <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded dark:hover:bg-blue-600 dark:bg-blue-800 dark:hover:bg-blue-950">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection
