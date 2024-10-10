@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4 dark:text-white">Créer un Client</h1>
        <form action="{{ route('clients.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4 dark:bg-gray-700 dark:shadow-md  ">
            @csrf
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label for="complete_name" class="block font-medium text-gray-700 dark:text-gray-300">Nom Complet</label>
                    <input type="text" name="complete_name" id="complete_name" class="w-full border border-gray-300 p-2 rounded" >
                    @error('complete_name')
                    <div class="bg-red-500 text-white"></div>
                    @enderror
                </div>

                <div>
                    <label for="type_client" class="block font-medium text-gray-700 dark:text-gray-300">Type de Client</label>
                    <input type="text" name="type_client" id="type_client" class="w-full border border-gray-300 p-2 rounded" >
                </div>

                <div>
                    <label for="email" class="block font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <div>
                    <label for="created_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de Création</label>
                    <input type="datetime-local" name="created_date" id="created_date" class="w-full border border-gray-300 p-2 rounded" >
                </div>

                <div>
                    <label for="phone_number" class="block font-medium text-gray-700 dark:text-gray-300">Numéro de Téléphone</label>
                    <input type="text" name="phone_number" id="phone_number" class="w-full border border-gray-300 p-2 rounded" >
                </div>

                <div>
                    <label for="birth_date" class="block font-medium text-gray-700 dark:text-gray-300">Date de Naissance</label>
                    <input type="date" name="birth_date" id="birth_date" class="w-full border border-gray-300 p-2 rounded" >
                </div>

                <div>
                    <label for="gender" class="block font-medium text-gray-700 dark:text-gray-300">Genre</label>
                    <select name="gender" id="gender" class="w-full border border-gray-300 p-2 rounded" >
                        <option value="Femme">Femme</option>
                        <option value="Homme">Homme</option>
                    </select>
                </div>

                <div>
                    <label for="comment" class="block font-medium text-gray-700 dark:text-gray-300">Commentaire</label>
                    <textarea name="comment" id="comment" class="w-full border border-gray-300 p-2 rounded"></textarea>
                </div>

                <div>
                    <label for="pays_id" class="block font-medium text-gray-700 dark:text-gray-300">Pays</label>
                    <select name="pays_id" id="pays_id" class="w-full border border-gray-300 p-2 rounded">
                        @foreach($pays as $pay)
                            <option value="{{ $pay->id }}">{{ strtoupper($pay->name) }} - {{ strtoupper($pay->code) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-row justify-between">
                    <a href="{{ route('clients.index') }}" class="bg-gray-500 text-white py-2 px-3 rounded">&leftarrow;</a>
                    <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">Enregistrer</button>

                </div>
            </div>
        </form>
    </div>

@endsection
