@extends('layouts.template')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Créer une Nouvelle Affaire</h2>
        <form action="{{ route('affaires.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <label class="block font-semibold">Nom</label>
            <input type="text" name="name" id="name" class="w-full mb-4 border-gray-300" required>

            <label class="block font-semibold">Date de Début</label>
            <input type="datetime-local" id="starting_date" name="starting_date" class="w-full mb-4 border-gray-300" required>

            <label class="block font-semibold">Date de Fin</label>
            <input type="datetime-local" name="ending_date" id="ending_date" class="w-full mb-4 border-gray-300" required>

            <label class="block font-semibold">Référence</label>
            <input type="text" name="reference" id="reference" class="w-full mb-4 border-gray-300">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
        </form>
    </div>

@endsection
