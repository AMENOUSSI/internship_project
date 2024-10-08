@extends('layouts.template')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Mouvements de Police</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('mouvements.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un Mouvement</a>

        <table class="min-w-full mt-4 border border-gray-300">
            <thead>
            <tr>
                <th class="py-2 px-4 border">Type</th>
                <th class="py-2 px-4 border">Client</th>
                <th class="py-2 px-4 border">Date de début</th>
                <th class="py-2 px-4 border">Date de fin</th>
                <th class="py-2 px-4 border">Commentaire</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mouvements as $mouvement)
                <tr>
                    <td class="py-2 px-4 border">{{ $mouvement->type }}</td>
                    <td class="py-2 px-4 border">{{ $mouvement->client->complete_name }}</td>
                    <td class="py-2 px-4 border">{{ $mouvement->starting_date }}</td>
                    <td class="py-2 px-4 border">{{ $mouvement->ending_date }}</td>
                    <td class="py-2 px-4 border">{{ $mouvement->comment }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('mouvements.show', $mouvement) }}" class="text-blue-500">Voir</a>
                        <a href="{{ route('mouvements.edit', $mouvement) }}" class="text-yellow-500">Modifier</a>
                        <form action="{{ route('mouvements.destroy', $mouvement) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection



