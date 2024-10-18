@extends('layouts.template')

@section('content')
    <h1>Ajouter une Facture</h1>
    @include('factures._form', [
        'action' => route('factures.store'),
        'buttonText' => 'Ajouter',
        'clients' => $clients,
    ])
@endsection
