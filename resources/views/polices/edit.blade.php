@extends('layouts.template')

@section('content')
    <h1 class="text-2xl font-bold mb-4 dark:text-gray-100">Modifier la Police</h1>
    @include('polices.form', ['action' => route('polices.update', $police), 'method' => 'PUT', 'police' => $police])
@endsection
