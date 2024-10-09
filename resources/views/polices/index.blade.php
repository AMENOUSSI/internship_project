@extends('layouts.template')

@section('content')
    <div class="container mx-auto ">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Liste des Assurances</h1>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="showModal()">Ajouter Assurance</button>
                <button class="bg-gray-800 text-white px-4 py-2 rounded ml-2" onclick="toggleDarkMode()">Mode Sombre</button>
            </div>
        </div>

        <table class="w-full bg-white dark:bg-gray-800 dark:text-gray-200 rounded shadow-lg">
            <thead>
            <tr>
                <th class="px-4 py-2">Client</th>
                <th class="px-4 py-2">Assureur</th>
                <th class="px-4 py-2">Affaire</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Début</th>
                <th class="px-4 py-2">Fin</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($polices as $police)
                <tr class="border-t dark:border-gray-700">
                    <td class="px-4 py-2">{{ $police->client->complete_name }}</td>
                    <td class="px-4 py-2">{{ $police->assureur->name }}</td>
                    <td class="px-4 py-2">{{ $police->affaire->name }}</td>
                    <td class="px-4 py-2">{{ $police->assurance_type }}</td>
                    <td class="px-4 py-2">{{ $police->starting_date }}</td>
                    <td class="px-4 py-2">{{ $police->ending_date }}</td>
                    <td class="px-4 py-2">
                        <button class="text-yellow-500" onclick="editAssurance({{ $police }})">Modifier</button>
                        <form action="{{ route('polices.destroy', $police->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div id="assuranceModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden py-12">
            <div class="bg-white dark:bg-gray-800 rounded shadow-lg w-96" id="modalContent">
                <h2 class="text-xl font-bold mb-4 dark:text-white" id="modalTitle">Ajouter Assurance</h2>
                <form id="assuranceForm" method="POST" action="{{ route('polices.store') }}" class="space-y-4">
                    @csrf
                    @if(isset($police))
                        @method('PUT')
                    @endif
                    <input type="hidden" id="assuranceId" name="id">
                    <div>
                        <label for="client_id" class="block text-sm font-medium dark:text-gray-200">Client</label>
                        <select id="client_id" name="client_id" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->complete_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="assureur_id" class="block text-sm font-medium dark:text-gray-200">Assureur</label>
                        <select id="assureur_id" name="assureur_id" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200">
                            @foreach($assureurs as $assureur)
                                <option value="{{ $assureur->id }}">{{ $assureur->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="affaire_id" class="block text-sm font-medium dark:text-gray-200">Affaire</label>
                        <select id="affaire_id" name="affaire_id" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200">
                            @foreach($affaires as $affaire)
                                <option value="{{ $affaire->id }}">{{ $affaire->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="assurance_type" class="block text-sm font-medium dark:text-gray-200">Type d'Assurance</label>
                        <input type="text" id="assurance_type" name="assurance_type" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" required>
                    </div>
                    <div>
                        <label for="starting_date" class="block text-sm font-medium dark:text-gray-200">Date de Début</label>
                        <input type="datetime-local" id="starting_date" name="starting_date" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" required>
                    </div>
                    <div>
                        <label for="ending_date" class="block text-sm font-medium dark:text-gray-200">Date de Fin</label>
                        <input type="datetime-local" id="ending_date" name="ending_date" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" required>
                    </div>
                    <div>
                        <label for="reference" class="block text-sm font-medium dark:text-gray-200">Référence</label>
                        <input type="text" id="reference" name="reference" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showModal() {
            clearForm();
            document.getElementById('modalTitle').textContent = 'Ajouter Assurance';
            document.getElementById('assuranceModal').classList.remove('hidden');
        }

        function editAssurance(police) {
            document.getElementById('modalTitle').textContent = 'Modifier Assurance';
            document.getElementById('assuranceId').value = police.id;
            document.getElementById('client_id').value = police.client_id;
            document.getElementById('assureur_id').value = police.assureur_id;
            document.getElementById('affaire_id').value = police.affaire_id;
            document.getElementById('assurance_type').value = police.assurance_type;
            document.getElementById('starting_date').value = police.starting_date.replace(' ', 'T');
            document.getElementById('ending_date').value = police.ending_date.replace(' ', 'T');
            document.getElementById('reference').value = police.reference;
            document.getElementById('assuranceForm').action = `/polices/${police.id}`;
            document.getElementById('assuranceModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('assuranceModal').classList.add('hidden');
        }

        function clearForm() {
            document.getElementById('assuranceForm').reset();
            document.getElementById('assuranceId').value = '';
            document.getElementById('assuranceForm').action = '{{ route('polices.store') }}';
        }

        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }
    </script>
@endsection
