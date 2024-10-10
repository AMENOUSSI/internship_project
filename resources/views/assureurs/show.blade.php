@extends('layouts.template')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">Details de l'assureur</h2>

        <div class="bg-white p-6 rounded shadow-md">
            <div class="mb-4 ">
                <p class="text-gray-700 font-bold">Nom de l'assureur:</p>
                <p>{{ $assureur->name }}</p>
            </div>



            <a href="{{ route('assureurs.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4 inline-block">Retour</a>
        </div>
    </div>
@endsection
