@extends('layouts.app')

@section('content')
    <h1>Modifier la Facture</h1>
    @include('factures._form', [
        'action' => route('factures.update', $facture->id),
        'method' => 'PUT',
        'buttonText' => 'Mettre à jour',
        'clients' => $clients,
        'facture' => $facture
    ])
@endsection
