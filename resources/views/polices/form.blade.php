<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf
    @method($method)

    <!-- Client -->
    <div>
        <label for="client_id" class="block font-semibold">Client :</label>
        <select name="client_id" id="client_id" required class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Sélectionnez un client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                    {{ (isset($police) && $police->client_id == $client->id) || old('client_id') == $client->id ? 'selected' : '' }}>
                    {{ $client->complete_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Assureur -->
    <div>
        <label for="assureur_id" class="block font-semibold">Assureur :</label>
        <select name="assureur_id" id="assureur_id" required class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Sélectionnez un assureur</option>
            @foreach($assureurs as $assureur)
                <option value="{{ $assureur->id }}"
                    {{ (isset($police) && $police->assureur_id == $assureur->id) || old('assureur_id') == $assureur->id ? 'selected' : '' }}>
                    {{ $assureur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Affaire -->
    <div>
        <label for="affaire_id" class="block font-semibold">Affaire :</label>
        <select name="affaire_id" id="affaire_id" required class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Sélectionnez une affaire</option>
            @foreach($affaires as $affaire)
                <option value="{{ $affaire->id }}"
                    {{ (isset($police) && $police->affaire_id == $affaire->id) || old('affaire_id') == $affaire->id ? 'selected' : '' }}>
                    {{ $affaire->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Assurance -->
    <div>
        <label for="assurance_id" class="block font-semibold">Assurance :</label>
        <select name="assurance_id" id="assurance_id" required class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Sélectionnez une assurance</option>
            @foreach($assurances as $assurance)
                <option value="{{ $assurance->id }}"
                    {{ (isset($police) && $police->assurance_id == $assurance->id) || old('assurance_id') == $assurance->id ? 'selected' : '' }}>
                    {{ $assurance->assurance_type }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Date de Début -->
    <div>
        <label for="starting_date" class="block font-semibold">Date de début :</label>
        <input type="datetime-local" name="starting_date" id="starting_date" required
               value="{{ old('starting_date', isset($police) ? \Carbon\Carbon::parse($police->starting_date)->format('Y-m-d\TH:i') : '') }}"
               class="block w-full p-2 border border-gray-300 rounded">
    </div>

    <!-- Date de Fin -->
    <div>
        <label for="ending_date" class="block font-semibold">Date de fin :</label>
        <input type="datetime-local" name="ending_date" id="ending_date"
               value="{{ old('ending_date', isset($police) && $police->ending_date ? \Carbon\Carbon::parse($police->ending_date)->format('Y-m-d\TH:i') : '') }}"
               class="block w-full p-2 border border-gray-300 rounded">
    </div>

    <!-- Référence -->
    <div>
        <label for="reference" class="block font-semibold">Référence :</label>
        <input type="text" name="reference" id="reference" maxlength="255"
               value="{{ old('reference', isset($police) ? $police->reference : '') }}"
               class="block w-full p-2 border border-gray-300 rounded" placeholder="Entrez la référence (facultatif)">
    </div>

    <!-- Bouton d'Envoi -->
    <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $method == 'POST' ? 'Ajouter' : 'Mettre à jour' }}
        </button>
    </div>
</form>
