@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Ajouter un Mouvement</h1>

        <form action="{{ route('mouvements.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="type" class="block mb-2">Type</label>
                <input type="text" name="type" id="type" class="border p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="client_id" class="block mb-2">Client</label>
                <select name="client_id" id="client_id" class="border p-2 w-full" required>
                    <option value="">Sélectionner un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->complete_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="starting_date" class="block mb-2">Date de début</label>
                <input type="datetime-local" name="starting_date" id="starting_date" class="border p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="ending_date" class="block mb-2">Date de fin</label>
                <input type="datetime-local" name="ending_date" id="ending_date" class="border p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label for="comment" class="block mb-2">Commentaire</label>
                <textarea name="comment" id="comment" class="border p-2 w-full"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
        </form>
    </div>

@endsection
