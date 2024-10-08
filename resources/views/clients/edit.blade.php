@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Modifier le Client</h1>
        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="complete_name" class="block font-medium text-gray-700">Nom Complet</label>
                <input type="text" name="complete_name" id="complete_name" value="{{ $client->complete_name }}" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label for="type_client" class="block font-medium text-gray-700">Type de Client</label>
                <input type="text" name="type_client" id="type_client" value="{{ $client->type_client }}" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $client->email }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label for="created_date" class="block font-medium text-gray-700">Date de Création</label>
                <input type="datetime-local" name="created_date" id="created_date" value="{{ $client->created_date }}" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label for="phone_number" class="block font-medium text-gray-700">Numéro de Téléphone</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ $client->phone_number }}" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label for="birth_date" class="block font-medium text-gray-700">Date de Naissance</label>
                <input type="date" name="birth_date" id="birth_date" value="{{ $client->birth_date }}" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label for="gender" class="block font-medium text-gray-700">Genre</label>
                <select name="gender" id="gender" class="w-full border border-gray-300 p-2 rounded" required>
                    <option value="Femme" {{ $client->gender == 'Femme' ? 'selected' : '' }}>Femme</option>
                    <option value="Homme" {{ $client->gender == 'Homme' ? 'selected' : '' }}>Homme</option>
                </select>
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
            </div>

            <div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Mettre à jour</button>
                <a href="{{ route('clients.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
            </div>
        </form>
    </div>
@endsection
