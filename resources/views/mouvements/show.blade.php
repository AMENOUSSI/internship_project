@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Détails du Mouvement de Police</h1>

        <div class="bg-white shadow-md rounded-lg p-4">
            <p><strong>Type:</strong> {{ $mouvement->type }}</p>
            <p><strong>Client:</strong> {{ $mouvement->client->complete_name }}</p>
            <p><strong>Date de Début:</strong> {{ $mouvement->starting_date }}</p>
            <p><strong>Date de Fin:</strong> {{ $mouvement->ending_date }}</p>
            <p><strong>Commentaire:</strong> {{ $mouvement->comment }}</p>
        </div>

        <a href="{{ route('mouvements.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Retour à la liste</a>
    </div>@endsection
