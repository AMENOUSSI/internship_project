@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl text-white font-bold mb-4">Modifier le Client</h1>
        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4 dark:bg-gray-700 dark:shadow-md">
            @csrf
            @method('PUT')
            <div>
                <label for="type" class="block font-medium text-gray-700">Particulier ou Societe ?</label>
                <select name="type" id="type" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="Personne morale" {{ $client->type == 'Personne morale' ? 'selected' : '' }}>Personne morale</option>
                    <option value="Personne physique" {{ $client->type == 'Personne physique' ? 'selected' : '' }}>Personne Physique</option>
                </select>
                @error('type')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="complete_name" class="block font-medium text-gray-700">Nom Complet</label>
                <input type="text" name="complete_name" id="complete_name" value="{{ $client->complete_name }}" class="w-full border border-gray-300 p-2 rounded">
                @error('complete_name')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="adresse" class="block font-medium text-gray-700">Adresse du Client</label>
                <input type="text" name="adresse" id="adresse" value="{{ $client->adresse }}" class="w-full border border-gray-300 p-2 rounded" >
                @error('adresse')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $client->email }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label for="created_date" class="block font-medium text-gray-700">Date de Création</label>
                <input type="datetime-local" name="created_date" id="created_date" value="{{ $client->created_date }}" class="w-full border border-gray-300 p-2 rounded" >
                @error('created_date')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone_number" class="block font-medium text-gray-700">Numéro de Téléphone</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ $client->phone_number }}" class="w-full border border-gray-300 p-2 rounded">
                @error('phone_number')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_people_id" class="block font-medium text-gray-700">Secteur d'activite</label>
                <select name="category_people_id" id="category_people_id" class="w-full border border-gray-300 p-2 rounded">
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $client->category_people_id == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_people_id')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gender" class="block font-medium text-gray-700">Genre</label>
                <select name="gender" id="gender" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="Femme" {{ $client->gender == 'Femme' ? 'selected' : '' }}>Femme</option>
                    <option value="Homme" {{ $client->gender == 'Homme' ? 'selected' : '' }}>Homme</option>
                </select>
                @error('gender')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="created_date" class="block font-medium text-gray-700">Date de Création</label>
                <input type="datetime-local" name="created_date" id="created_date" value="{{ $client->created_date }}" class="w-full border border-gray-300 p-2 rounded">
                @error('created_date')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="comment" class="block font-medium text-gray-700">Commentaire</label>
                <textarea name="comment" id="comment" class="w-full border border-gray-300 p-2 rounded">{{ $client->comment }}</textarea>
            </div>

            <div>
                <label for="pays_id" class="block font-medium text-gray-700">Pays</label>
                <select name="pays_id" id="pays_id" class="w-full border border-gray-300 p-2 rounded">
                    @foreach($pays as $pay)
                        <option value="{{ $pay->id }}" {{ $client->pays_id == $pay->id ? 'selected' : '' }}>
                            {{ $pay->name }} - {{ strtoupper($pay->code) }}
                        </option>
                    @endforeach
                </select>
                @error('pays_id')
                <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Mettre à jour</button>
                <a href="{{ route('clients.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
            </div>
        </form>
    </div>
@endsection
