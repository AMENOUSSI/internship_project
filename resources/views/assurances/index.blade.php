@extends('layouts.template')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Liste des Assurances</h1>
        <a href="{{ route('assurances.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter une Assurance</a>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Client</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Assureur</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Affaire</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Type</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Date de début</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach ($assurances as $assurance)
                <tr>
                    <td class="py-3 px-4">{{ $assurance->client->complete_name }}</td>
                    <td class="py-3 px-4">{{ $assurance->assureur->name }}</td>
                    <td class="py-3 px-4">{{ $assurance->affaire->name }}</td>
                    <td class="py-3 px-4">{{ $assurance->assurance_type }}</td>
                    <td class="py-3 px-4">{{ Carbon\Carbon::parse($assurance->starting_date)->format('d/m/Y') }}</td>
                    <td class="py-3 px-4">

                        <a href="{{ route('assurances.show', $assurance->id) }}" class="bg-gray-500 text-white px-2 py-1 rounded">Voir</a>
                        <a href="{{ route('assurances.edit', $assurance->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</a>
                        <form action="{{ route('assurances.destroy', $assurance->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
