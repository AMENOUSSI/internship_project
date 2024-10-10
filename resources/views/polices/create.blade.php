@extends('layouts.template')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Ajouter une Police</h1>
    @include('polices.form', ['action' => route('polices.store'), 'method' => 'POST'])
@endsection
