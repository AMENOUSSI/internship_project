@extends('layouts.template')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg p-6 dark:bg-black dark:text-white">
            <h2 class="text-3xl text-blue-900 font-bold mb-6">Détails de la facture</h2>

            <div class="mb-4">
                <label class="font-semibold">Nom Complet:</label>
                <p class="text-gray-600">{{ $facture->client->complete_name }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">La reference de la facture:</label>
                <p class="text-gray-600">{{ $facture->reference }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">La date d'emission de la facture:</label>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse( $facture->emit_date)->format('d F Y ') ?? 'Non spécifié' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Date de payement:</label>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse( $facture->payment_date)->format('d F Y ') ?? 'Non spécifié' }}</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Montant:</label>
                <p class="text-gray-600">{{ $facture->amount }} F CFA</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Le statut actuel de la facture:</label>
                <p class="text-gray-600">{{ $facture->status }}</p>
            </div>

            <a href="{{ route('factures.index') }}" class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-950">
                Retour à la liste
            </a>
        </div>
    </div>
@endsection
