@extends('layouts.template')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Liste des Polices</h1>
    <a href="{{ route('polices.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter une Police</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border">
        <thead>
        <tr>
            <th>Client</th>
            <th>Assureur</th>
            <th>Affaire</th>
            <th>Assurance</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Référence</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($polices as $police)
            <tr>
                <td>{{ $police->client->complete_name }}</td>
                <td>{{ $police->assureur->name }}</td>
                <td>{{ $police->affaire->name }}</td>
                <td>{{ $police->assurance->assurance_type }}</td>
                <td>{{ $police->starting_date }}</td>
                <td>{{ $police->ending_date }}</td>
                <td>{{ $police->reference }}</td>
                <td>
                    <a href="{{ route('polices.edit', $police) }}" class="text-blue-500">Modifier</a>
                    <form action="{{ route('polices.destroy', $police) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
