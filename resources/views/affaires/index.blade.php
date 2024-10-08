@extends('layouts.template')
@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Liste des Affaires</h1>
        <a href="{{ route('affaires.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nouvelle Affaire</a>

        <table class="min-w-full bg-white mt-6">
            <thead>
            <tr>
                <th class="py-2">Nom</th>
                <th class="py-2">Date de Début</th>
                <th class="py-2">Date de Fin</th>
                <th class="py-2">Référence</th>
                <th class="py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($affaires as $affaire)
                <tr>
                    <td class="py-2 px-4">{{ $affaire->name }}</td>
                    <td class="py-2 px-4">{{ $affaire->starting_date }}</td>
                    <td class="py-2 px-4">{{ $affaire->ending_date }}</td>
                    <td class="py-2 px-4">{{ $affaire->reference }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('affaires.show', $affaire->id) }}" class="text-blue-500">Voir</a> |
                        <a href="{{ route('affaires.edit', $affaire->id) }}" class="text-green-500">Modifier</a> |
                        <form action="{{ route('affaires.destroy', $affaire->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette affaire?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
