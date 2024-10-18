@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4 dark:text-white">{{ isset($client) ? 'Modifier le Client' : 'Créer un Client' }}</h1>

        <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}"
              method="POST"
              class="bg-white p-6 rounded shadow-md space-y-4 dark:bg-gray-700 dark:shadow-md">

            @csrf
            @if(isset($client))
                @method('PUT')
            @endif

            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label for="type" class="block font-medium text-gray-700 dark:text-gray-300">Société ou particulier ?</label>
                    <select name="type" id="type" class="w-full border border-gray-300 p-2 rounded">
                        <option value="Personne morale" {{ old('type', $client->type ?? '') == 'Personne morale' ? 'selected' : '' }}>Personne morale</option>
                        <option value="Personne physique" {{ old('type', $client->type ?? '') == 'Personne physique' ? 'selected' : '' }}>Personne physique</option>
                    </select>
                    @error('type')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="complete_name" class="block font-medium text-gray-700 dark:text-gray-300">Nom complet du client</label>
                    <input type="text" name="complete_name" id="complete_name" value="{{ old('complete_name', $client->complete_name ?? '') }}" class="w-full border border-gray-300 p-2 rounded">
                    @error('complete_name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block font-medium text-gray-700 dark:text-gray-300">Email du client</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $client->email ?? '') }}" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <div>
                    <label for="created_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de Création</label>
                    <input type="datetime-local" name="created_date" id="created_date" value="{{ old('created_date', $client->created_date ?? '') }}" class="w-full border border-gray-300 p-2 rounded">
                    @error('created_date')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="phone_number" class="block font-medium text-gray-700 dark:text-gray-300">Numéro de Téléphone</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $client->phone_number ?? '') }}" class="w-full border border-gray-300 p-2 rounded">
                    @error('phone_number')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="birth_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de Naissance</label>
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $client->birth_date ?? '') }}" class="w-full border border-gray-300 p-2 rounded">
                    @error('birth_date')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="adresse" class="block font-medium text-gray-700 dark:text-gray-300">Adresse du client</label>
                    <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $client->adresse ?? '') }}" class="w-full border border-gray-300 p-2 rounded">
                    @error('adresse')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="category_people_id" class="block font-medium text-gray-700 dark:text-gray-300">Secteur d'activité</label>
                    <select name="category_people_id" id="category_people_id" class="w-full border border-gray-300 p-2 rounded">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_people_id', $client->category_people_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_people_id')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block font-medium text-gray-700 dark:text-gray-300">Genre</label>
                    <select name="gender" id="gender" class="w-full border border-gray-300 p-2 rounded">
                        <option value="Femme" {{ old('gender', $client->gender ?? '') == 'Femme' ? 'selected' : '' }}>Femme</option>
                        <option value="Homme" {{ old('gender', $client->gender ?? '') == 'Homme' ? 'selected' : '' }}>Homme</option>
                    </select>
                    @error('gender')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="comment" class="block font-medium text-gray-700 dark:text-gray-300">Commentaire sur le client</label>
                    <textarea name="comment" id="comment" class="w-full border border-gray-300 p-2 rounded">{{ old('comment', $client->comment ?? '') }}</textarea>
                </div>

                <div>
                    <label for="pays_id" class="block font-medium text-gray-700 dark:text-gray-300">Nationalité</label>
                    <select name="pays_id" id="pays_id" class="w-full border border-gray-300 p-2 rounded">
                        @foreach($pays as $pay)
                            <option value="{{ $pay->id }}" {{ old('pays_id', $client->pays_id ?? '') == $pay->id ? 'selected' : '' }}>
                                {{ strtoupper($pay->name) }} - {{ strtoupper($pay->code) }}
                            </option>
                        @endforeach
                    </select>
                    @error('pays_id')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-row justify-between">
                    <a href="{{ route('clients.index') }}" class="bg-gray-500 text-white py-2 px-3 rounded">&leftarrow;</a>
                    <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">
                        {{ isset($client) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
