@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Modifier le Mouvement de Police</h1>

        <form action="{{ route('mouvements.update', $mouvement->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <input type="text" name="type" id="type" value="{{ old('type', $mouvement->type) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Client -->
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select name="client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $mouvement->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->complete_name }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Starting Date -->
            <div class="mb-4">
                <label for="starting_date" class="block text-sm font-medium text-gray-700">Date de Début</label>
                <input type="datetime-local" name="starting_date" id="starting_date" value="{{ old('starting_date', $mouvement->starting_date) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('starting_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ending Date -->
            <div class="mb-4">
                <label for="ending_date" class="block text-sm font-medium text-gray-700">Date de Fin</label>
                <input type="datetime-local" name="ending_date" id="ending_date" value="{{ old('ending_date', $mouvement->ending_date) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('ending_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comment -->
            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700">Commentaire</label>
                <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('comment', $mouvement->comment) }}</textarea>
                @error('comment')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer les modifications</button>
                <a href="{{ route('mouvements.index') }}" class="text-gray-600 underline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
