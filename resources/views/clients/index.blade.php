@extends('layouts.template')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Liste des Clients</h1>
        <a href="{{ route('clients.create') }}" class="inline-flex items-center px-3 py-2 mb-4 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            Creer un client
        </a>        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b">Nom Complet</th>
                <th class="py-2 px-4 border-b">Type</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Date de Création</th>
                <th class="py-2 px-4 border-b">Téléphone</th>
                <th class="py-2 px-4 border-b">Pays</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $client->complete_name }}</td>
                    <td class="py-2 px-4">{{ $client->type_client }}</td>
                    <td class="py-2 px-4">{{ $client->email }}</td>
                    <td class="py-2 px-4">{{ $client->created_date }}</td>
                    <td class="py-2 px-4">{{ $client->phone_number }}</td>
                    <td class="py-2 px-4">{{ $client->pays->name  }}</td>
                    <td class="py-2 px-4 flex space-x-2">
                        <a href="{{ route('clients.edit', $client->id) }}" class="bg-green-500 text-white px-2 py-1 rounded">Modifier</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection



