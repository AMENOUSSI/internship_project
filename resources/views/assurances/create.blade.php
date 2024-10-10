@extends('layouts.template')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Assurances</h1>

        <!-- Modal toggle button -->
        <button data-modal-target="assurance-modal" data-modal-toggle="assurance-modal" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ajouter une Assurance
        </button>

        <!-- Main modal -->
        <div id="assurance-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Ajouter une Assurance
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="assurance-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 px-4 py-3 mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('assurances.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="client_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client :</label>
                                <select name="client_id" id="client_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->complete_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="assureur_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assureur :</label>
                                <select name="assureur_id" id="assureur_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach($assureurs as $assureur)
                                        <option value="{{ $assureur->id }}">{{ $assureur->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="affaire_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Affaire :</label>
                                <select name="affaire_id" id="affaire_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach($affaires as $affaire)
                                        <option value="{{ $affaire->id }}">{{ $affaire->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="assurance_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type d'assurance :</label>
                                <input type="text" name="assurance_type" id="assurance_type" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="starting_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de début :</label>
                                <input type="datetime-local" name="starting_date" id="starting_date" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="ending_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date de fin :</label>
                                <input type="datetime-local" name="ending_date" id="ending_date" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <div class="mb-4">
                                <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Référence :</label>
                                <input type="text" name="reference" id="reference" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                                Enregistrer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
