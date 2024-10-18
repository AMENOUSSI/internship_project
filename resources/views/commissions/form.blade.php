@extends('layouts.template')

@section('content')
    <div class="container mx-auto p-8 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-6">{{ isset($commission) ? 'Éditer la Commission' : 'Créer une Commission' }}</h1>

        <form action="{{ isset($commission) ? route('commissions.update', $commission->id) : route('commissions.store') }}" method="POST">
            @csrf
            @if(isset($commission))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select name="client_id" id="client_id" class="w-full mt-1 border border-gray-300 p-2 rounded">
                    <option value="">Sélectionnez un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ isset($commission) && $commission->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->complete_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="assurance_id" class="block text-sm font-medium text-gray-700">Assurance</label>
                <select name="assurance_id" id="assurance_id" class="w-full mt-1 border border-gray-300 p-2 rounded">
                    <option value="">Sélectionnez une assurance</option>
                    @foreach($assurances as $assurance)
                        <option value="{{ $assurance->id }}" {{ isset($commission) && $commission->assurance_id == $assurance->id ? 'selected' : '' }}>
                            {{ $assurance->assurance_type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="assureur_id" class="block text-sm font-medium text-gray-700">Assureur</label>
                <select name="assureur_id" id="assureur_id" class="w-full mt-1 border border-gray-300 p-2 rounded">
                    <option value="">Sélectionnez un assureur</option>
                    @foreach($assureurs as $assureur)
                        <option value="{{ $assureur->id }}" {{ isset($commission) && $commission->assureur_id == $assureur->id ? 'selected' : '' }}>
                            {{ $assureur->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="taux" class="block text-sm font-medium text-gray-700">Taux</label>
                <input type="text" name="taux" id="taux" value="{{ $commission->taux ?? old('taux') }}" class="w-full mt-1 border border-gray-300 p-2 rounded" placeholder="Exemple : 5%">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('commissions.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Annuler</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">
                    {{ isset($commission) ? 'Mettre à jour' : 'Créer' }}
                </button>
            </div>
        </form>
    </div>
@endsection
