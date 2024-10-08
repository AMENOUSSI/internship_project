@extends('layouts.template')

@section('content')
    <div class="container mx-auto dark:text-gray-100 dark:bg-gray-900 p-8 rounded">
        <h1 class="text-3xl font-bold mb-6">Liste des Assureurs</h1>

        <a href="{{ route('assureurs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded mb-4 inline-block">Ajouter un Assureur</a>

        <table class="w-full dark:bg-gray-800 rounded overflow-hidden">
            <thead class="bg-gray-700">
            <tr>
                <th class="py-3 px-4">ID</th>
                <th class="py-3 px-4">Nom</th>
                <th class="py-3 px-4">Slug</th>
                <th class="py-3 px-4">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($assureurs as $assureur)
                <tr class="border-b border-gray-700">
                    <td class="py-2 px-4">{{ $assureur->id }}</td>
                    <td class="py-2 px-4">{{ $assureur->name }}</td>
                    <td class="py-2 px-4">{{ $assureur->slug }}</td>
                    <td class="py-2 px-4 flex">
                        <a href="{{ route('assureurs.edit', $assureur->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white py-1 px-3 rounded mr-2">Modifier</a>
                        <form action="{{ route('assureurs.destroy', $assureur->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
