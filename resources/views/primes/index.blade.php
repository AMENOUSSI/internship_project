@extends('layouts.template')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Gestion des Primes</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <button id="createPrimeBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une Prime</button>

        <table class="min-w-full border border-gray-300 mt-4">
            <thead>
            <tr>
                <th class="border px-4 py-2">Client</th>
                <th class="border px-4 py-2">Police</th>
                <th class="border px-4 py-2">Prime Nette</th>
                <th class="border px-4 py-2">Assessors</th>
                <th class="border px-4 py-2">Taxe</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($primes as $prime)
                <tr>
                    <td class="border px-4 py-2">{{ $prime->client->complete_name }}</td>
                    <td class="border px-4 py-2">{{ $prime->police->id }}</td>
                    <td class="border px-4 py-2">{{ $prime->prime_nette }}</td>
                    <td class="border px-4 py-2">{{ $prime->assessors }}</td>
                    <td class="border px-4 py-2">{{ $prime->tax }}</td>
                    <td class="border px-4 py-2">
                        <button class="editPrimeBtn bg-yellow-500 text-white px-2 py-1 rounded" data-id="{{ $prime->id }}">Modifier</button>
                        <form action="{{ route('primes.destroy', $prime) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div id="primeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Ajouter / Modifier une Prime</h2>
                <form id="primeForm" action="{{ route('primes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="id" id="prime_id">

                    <div class="mb-4">
                        <label for="client_id" class="block font-semibold">Client :</label>
                        <select name="client_id" id="client_id" required class="block w-full p-2 border border-gray-300 rounded">
                            <option value="">Sélectionnez un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->complete_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="police_id" class="block font-semibold">Police :</label>
                        <select name="police_id" id="police_id" required class="block w-full p-2 border border-gray-300 rounded">
                            <option value="">Sélectionnez une police</option>
                            @foreach($polices as $police)
                                <option value="{{ $police->id }}">{{ $police->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="prime_nette" class="block font-semibold">Prime Nette :</label>
                        <input type="number" name="prime_nette" id="prime_nette" step="0.01" required class="block w-full p-2 border border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label for="assessors" class="block font-semibold">Assessors :</label>
                        <input type="number" name="assessors" id="assessors" step="0.01" required class="block w-full p-2 border border-gray-300 rounded">
                    </div>

                    <div class="mb-4">
                        <label for="tax" class="block font-semibold">Taxe :</label>
                        <input type="number" name="tax" id="tax" step="0.01" required class="block w-full p-2 border border-gray-300 rounded">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
                    <button type="button" id="closeModalBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Annuler</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('createPrimeBtn').addEventListener('click', function() {
            document.getElementById('primeModal').classList.remove('hidden');
            document.getElementById('primeForm').reset();
            document.getElementById('method').value = 'POST';
            document.getElementById('prime_id').value = '';
        });

        document.querySelectorAll('.editPrimeBtn').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/primes/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        // Remplir le formulaire avec les données de la prime
                        document.getElementById('prime_id').value = data.prime.id; // ID de la prime
                        document.getElementById('client_id').value = data.prime.client_id; // ID du client
                        document.getElementById('police_id').value = data.prime.police_id; // ID de la police
                        document.getElementById('prime_nette').value = data.prime.prime_nette; // Valeur de la prime nette
                        document.getElementById('assessors').value = data.prime.assessors; // Valeur des assessors
                        document.getElementById('tax').value = data.prime.tax; // Valeur de la taxe

                        // Changer l'action et la méthode pour la mise à jour
                        document.getElementById('primeForm').action = `/primes/${id}`;
                        document.getElementById('method').value = 'PUT'; // Changer la méthode à PUT pour mise à jour

                        // Ouvrir le modal
                        document.getElementById('primeModal').classList.remove('hidden');
                    });
            });
        });
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('primeModal').classList.add('hidden');
        });
    </script>

@endsection
