@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="dark:text-gray-400 text-2xl font-bold mb-4">Ajouter un Mouvement</h1>
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mouvements.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4 dark:bg-gray-700 dark:shadow-md  ">
            @csrf
            <div class="mb-4">
                <label for="type" class="block font-medium text-gray-700 dark:text-gray-300">Type de mouvement de police</label>
                <select name="type" id="type" class="border border-neutral-500  p-2 w-full rounded focus:outline-none focus:ring focus:ring-neutral-300">
                    <option value="renouvellement">Renouvellement</option>
                    <option value="incorporation">Incorporation</option>
                    <option value="retrait">Retrait</option>


                </select>
            </div>

            <div class="mb-4">
                <label for="client_id" class="block font-medium text-gray-700 dark:text-gray-300">Client</label>
                <select name="client_id" id="client_id" class="border border-neutral-500  p-2 w-full rounded focus:outline-none focus:ring focus:ring-neutral-300">
                    <option value="">Sélectionner un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->complete_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-4">
                <label for="starting_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de début</label>
                <input type="datetime-local" name="starting_date" id="starting_date" class="border border-neutral-500  p-2 w-full rounded focus:outline-none focus:ring focus:ring-neutral-300">
            </div>

            <div class="mb-4">
                <label for="ending_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de fin</label>
                <input type="datetime-local" name="ending_date" id="ending_date" class="border border-neutral-500  p-2 w-full rounded focus:outline-none focus:ring focus:ring-neutral-300">
            </div>

            <div class="mb-4">
                <label for="comment" class="block font-medium text-gray-700 dark:text-gray-300">Commentaire</label>
                <textarea name="comment" id="comment" class="border border-neutral-500 p-2 w-full rounded focus:outline-none focus:ring focus:ring-neutral-300"></textarea>
            </div>

            <button type="submit" class="bg-neutral-800 text-white px-4 py-2 rounded justify-end">Envoyer</button>
        </form>
    </div>

@endsection
