
<form action="{{ $action }}" method="POST" class="space-y-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
    @csrf
    @method($method)

    <!-- Client -->
    <div>
        <label for="client_id" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Client :</label>
        <select name="client_id" id="client_id" required class="block w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500">
            <option value="" disabled selected>Sélectionnez un client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ (isset($police) && $police->client_id == $client->id) || old('client_id') == $client->id ? 'selected' : '' }}>
                    {{ $client->complete_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Assureur -->
    <div>
        <label for="assureur_id" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Assureur :</label>
        <select name="assureur_id" id="assureur_id" required class="block w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500">
            <option value="" disabled selected>Sélectionnez un assureur</option>
            @foreach($assureurs as $assureur)
                <option value="{{ $assureur->id }}" {{ (isset($police) && $police->assureur_id == $assureur->id) || old('assureur_id') == $assureur->id ? 'selected' : '' }}>
                    {{ $assureur->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Affaire -->
    <div>
        <label for="affaire_id" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Affaire :</label>
        <select name="affaire_id" id="affaire_id" required class="block w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500">
            <option value="" disabled selected>Sélectionnez une affaire</option>
            @foreach($affaires as $affaire)
                <option value="{{ $affaire->id }}" {{ (isset($police) && $police->affaire_id == $affaire->id) || old('affaire_id') == $affaire->id ? 'selected' : '' }}>
                    {{ $affaire->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Assurance -->
    <div>
        <label for="assurance_id" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Assurance :</label>
        <select name="assurance_id" id="assurance_id" required class="block w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500">
            <option value="" disabled selected>Sélectionnez une assurance</option>
            @foreach($assurances as $assurance)
                <option value="{{ $assurance->id }}" {{ (isset($police) && $police->assurance_id == $assurance->id) || old('assurance_id') == $assurance->id ? 'selected' : '' }}>
                    {{ $assurance->assurance_type }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Date de Début -->
    <div>
        <label for="starting_date" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Date de début :</label>
        <input type="datetime-local" name="starting_date" id="starting_date" required class="block w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500" value="{{ old('starting_date', isset($police) ? \Carbon\Carbon::parse($police->starting_date)->format('Y-m-d\TH:i') : '') }}">
    </div>

    <!-- Date de Fin -->
    <div>
        <label for="ending_date" class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Date de fin :</label>
        <input type="datetime-local" name="ending_date" id="ending_date" class="block w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500" value="{{ old('ending_date', isset($police) && $police->ending_date ? \Carbon\Carbon::parse($police->ending_date)->format('Y-m-d\TH:i') : '') }}">
    </div>


    <!-- Bouton d'Envoi -->
    <div class="text-right">
        <button type="submit" class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:from-green-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500">
            {{ $method == 'POST' ? 'Ajouter' : 'Mettre à jour' }}
        </button>
    </div>
</form>
