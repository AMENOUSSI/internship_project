@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4 dark:text-white">
            {{ isset($mouvement) ? 'Éditer le Mouvement Police' : 'Créer un Mouvement Police' }}
        </h1>
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ isset($mouvement) ? route('mouvements.update', $mouvement->id) : route('mouvements.store') }}"
            method="POST"
            class="bg-white p-6 rounded shadow-md space-y-4 dark:bg-gray-700 dark:shadow-md"
        >
            @csrf
            @if(isset($mouvement))
                @method('PUT')
            @endif

            <div class="grid grid-cols-3 gap-6">
                <!-- Type de mouvement -->
                <div>
                    <label for="type" class="block font-medium text-gray-700 dark:text-gray-300">Type de Mouvement</label>
                    <select name="type" id="type" class="w-full border border-gray-300 p-2 rounded">
                        <option value="renouvellement" {{ (isset($mouvement) && $mouvement->type == 'renouvellement') ? 'selected' : '' }}>Renouvellement</option>
                        <option value="incorporation" {{ (isset($mouvement) && $mouvement->type == 'incorporation') ? 'selected' : '' }}>Incorporation</option>
                        <option value="retrait" {{ (isset($mouvement) && $mouvement->type == 'retrait') ? 'selected' : '' }}>Retrait</option>
                    </select>
                    @error('type')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de début -->
                <div>
                    <label for="starting_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de Début</label>
                    <input type="datetime-local" name="starting_date" id="starting_date"
                           value="{{ isset($mouvement) ? $mouvement->starting_date : old('starting_date') }}"
                           class="w-full border border-gray-300 p-2 rounded">
                    @error('starting_date')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de fin -->
                <div>
                    <label for="ending_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de Fin</label>
                    <input type="datetime-local" name="ending_date" id="ending_date"
                           value="{{ isset($mouvement) && $mouvement->ending_date ? $mouvement->ending_date : old('ending_date') }}"
                           class="w-full border border-gray-300 p-2 rounded">
                    @error('ending_date')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Commentaire -->
                <div>
                    <label for="comment" class="block font-medium text-gray-700 dark:text-gray-300">Commentaire</label>
                    <textarea name="comment" id="comment" class="w-full border border-gray-300 p-2 rounded">{{ isset($mouvement) ? $mouvement->comment : old('comment') }}</textarea>
                    @error('comment')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Client -->
                <div>
                    <label for="client_id" class="block font-medium text-gray-700 dark:text-gray-300">Client</label>
                    <select name="client_id" id="client_id" class="w-full border border-gray-300 p-2 rounded">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ (isset($mouvement) && $mouvement->client_id == $client->id) ? 'selected' : '' }}>
                                {{ $client->complete_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Reference -->
                <div>
                    <label for="reference" class="block font-medium text-gray-700 dark:text-gray-300">Référence</label>
                    <input type="text" name="reference" id="reference"
                           value="{{ isset($mouvement) ? $mouvement->reference : old('reference') }}"
                           class="w-full border border-gray-300 p-2 rounded">
                    @error('reference')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-row justify-between mt-4">
                <a href="{{ route('mouvements.index') }}" class="bg-gray-500 text-white py-2 px-3 rounded">&leftarrow; Retour</a>
                <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">
                    {{ isset($mouvement) ? 'Mettre à jour' : 'Créer' }}
                </button>
            </div>
        </form>
    </div>
@endsection
