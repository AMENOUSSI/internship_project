@extends('layouts.template')

@section('content')
    <div class="container mx-auto text-white bg-gray-400 dark:text-gray-100 dark:bg-gray-900 p-8 rounded">
        <h1 class="text-3xl font-bold mb-6">{{ isset($police) ? 'Modifier' : 'Enregistrer' }} une Police</h1>

        <form action="{{ isset($police) ? route('assureurs.update', $police->id) : route('assureurs.store') }}" method="POST">
            @csrf
            @if(isset($police))
                @method('PUT')
            @endif

            <div class="mb-4">
                {{--<label for="name" class="block text-gray-300">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $assureur->name ?? '') }}" class="bg-gray-800 text-gray-300 w-full p-2 rounded">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror--}}
                <select name="client_id" id="client_id">
                    <label for="client_id" class="bg-gray-800 text-gray-300 w-full p-2 rounded">Selectionner le client</label>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->complete_name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <select name="client_id" id="client_id">
                    <label for="client_id" class="bg-gray-800 text-gray-300 w-full p-2 rounded">Selectionner le client</label>
                    @foreach($affaires as $affaire)
                        <option value="{{ $affaire->id }}">{{ $affaire->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <select name="client_id" id="client_id">
                    <label for="client_id" class="bg-gray-800 text-gray-300 w-full p-2 rounded">Selectionner l'assureur'</label>
                    @foreach($assureurs as $assureur)
                        <option value="{{ $assureur->id }}">{{ $assureur->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">{{ isset($police) ? 'Modifier' : 'Ajouter' }}</button>
            <a href="{{ route('assureurs.index') }}" class="text-gray-400 underline ml-4">Annuler</a>
        </form>
    </div>


@endsection
