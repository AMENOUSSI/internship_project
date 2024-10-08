@extends('layouts.template')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg p-6 dark:bg-black dark:text-white">
            <h2 class="text-2xl font-bold mb-6">Détails du Client</h2>

            <div class="mb-4">
                <label class="font-semibold">Nom Complet:</label>
                <p class="text-gray-400">{{ $client->complete_name }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Type de Client:</label>
                <p class="text-gray-400">{{ $client->type_client }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Email:</label>
                <p class="text-gray-400">{{ $client->email ?? 'Non spécifié' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Date de Création:</label>
                <p class="text-gray-400">{{ $client->created_date }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Numéro de Téléphone:</label>
                <p class="text-gray-700">{{ $client->phone_number }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Date de Naissance:</label>
                <p class="text-gray-400">{{ $client->birth_date }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Genre:</label>
                <p class="text-gray-700">{{ $client->gender }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Commentaire:</label>
                <p class="text-gray-700">{{ $client->comment ?? 'Non spécifié' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Pays:</label>
                <p class="text-gray-700">{{ $client->pays ? $client->pays->name : 'Non spécifié' }}</p>
            </div>

            <a href="{{ route('clients.index') }}" class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-950">
                Retour à la liste
            </a>
        </div>
    </div>
@endsection
