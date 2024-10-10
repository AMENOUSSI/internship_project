@extends('layouts.template')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Détails de l'Assurance</h1>

        <p><strong>Client :</strong> {{ $assurance->client->complete_name }}</p>
        <p><strong>Assureur :</strong> {{ $assurance->assureur->name }}</p>
        <p><strong>Affaire :</strong> {{ $assurance->affaire->name }}</p>
        <p><strong>Type d'assurance :</strong> {{ $assurance->assurance_type }}</p>
        <p><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($assurance->starting_date)->format('d/m/Y H:i') }}</p>
        <p><strong>Date de fin :</strong> {{  \Carbon\Carbon::parse($assurance->ending_date)->format('d/m/Y H:i') }}</p>
        <p><strong>Référence :</strong> {{ $assurance->reference }}</p>

        <a href="{{ route('assurances.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
    </div>
@endsection
