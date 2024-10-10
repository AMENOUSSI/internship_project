@extends('layouts.template')

@section('content')
    <!-- Trigger du modal -->
    <button class="bg-blue-500 text-white px-4 py-2 rounded" data-modal-toggle="assurance-modal">Modifier l'Assurance</button>

    <!-- Modal -->
    <div id="assurance-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-5/6 lg:w-3/4 xl:w-1/2 rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-2xl font-bold">Modifier l'Assurance</h2>
                <button class="text-gray-500 hover:text-red-600" onclick="closeModal('editAssuranceModal')">&times;</button>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('assurances.update', $assurance) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champ Client -->
                <label for="client_id">Client :</label>
                <select name="client_id" id="client_id" required class="w-full border rounded px-3 py-2 mb-4">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $assurance->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->complete_name }}
                        </option>
                    @endforeach
                </select>

                <!-- Champ Assureur -->
                <label for="assureur_id">Assureur :</label>
                <select name="assureur_id" id="assureur_id" required class="w-full border rounded px-3 py-2 mb-4">
                    @foreach($assureurs as $assureur)
                        <option value="{{ $assureur->id }}" {{ $assurance->assureur_id == $assureur->id ? 'selected' : '' }}>
                            {{ $assureur->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Champ Affaire -->
                <label for="affaire_id">Affaire :</label>
                <select name="affaire_id" id="affaire_id" required class="w-full border rounded px-3 py-2 mb-4">
                    @foreach($affaires as $affaire)
                        <option value="{{ $affaire->id }}" {{ $assurance->affaire_id == $affaire->id ? 'selected' : '' }}>
                            {{ $affaire->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Champ Type d'assurance -->
                <label for="assurance_type">Type d'assurance :</label>
                <input type="text" name="assurance_type" id="assurance_type" value="{{ $assurance->assurance_type }}" required class="w-full border rounded px-3 py-2 mb-4">

                <!-- Champ Date de début -->
                <label for="starting_date">Date de début :</label>
                <input type="datetime-local" name="starting_date" id="starting_date" value="{{ \Carbon\Carbon::parse($assurance->starting_date)->format('Y-m-d\TH:i') }}" required class="w-full border rounded px-3 py-2 mb-4">

                <!-- Champ Date de fin -->
                <label for="ending_date">Date de fin :</label>
                <input type="datetime-local" name="ending_date" id="ending_date" value="{{ \Carbon\Carbon::parse($assurance->ending_date)->format('Y-m-d\TH:i') }}" required class="w-full border rounded px-3 py-2 mb-4">

                <!-- Champ Référence -->
                <label for="reference">Référence :</label>
                <input type="text" name="reference" id="reference" value="{{ $assurance->reference }}" class="w-full border rounded px-3 py-2 mb-4">

                <!-- Bouton Submit -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
            </form>
        </div>
    </div>

    {{--<script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>--}}
@endsection
