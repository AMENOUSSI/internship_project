<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <!-- Client -->
    <div>
        <label for="client_id" class="block font-semibold">Client :</label>
        <select name="client_id" id="client_id"  class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Sélectionnez un client</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                    {{ (isset($facture) && $facture->client_id == $client->id) || old('client_id') == $client->id ? 'selected' : '' }}>
                    {{ $client->complete_name }}
                </option>
            @endforeach
        </select>
        @error('client_id')
        <span class="text-red-500 text-md">{{$message}}</span>
        @enderror
    </div>

    <!-- Montant -->
    <div>
        <label for="amount" class="block font-semibold">Montant :</label>
        <input type="number" step="0.01" name="amount" id="amount"
               value="{{ old('amount', $facture->amount ?? '') }}"
               class="block w-full p-2 border border-gray-300 rounded" placeholder="Entrez le montant">
        @error('amount')
        <span class="text-red-500 text-md">{{$message}}</span>
        @enderror
    </div>

    <!-- Date d'Émission -->
    <div>
        <label for="emit_date" class="block font-semibold">Date d'émission :</label>
        <input type="datetime-local" name="emit_date" id="emit_date"
               value="{{ old('emit_date', isset($facture) ? $facture->emit_date : '') }}"
               class="block w-full p-2 border border-gray-300 rounded">
        @error('emit_date')
        <span class="text-red-500 text-md">{{$message}}</span>
        @enderror
    </div>

    <!-- Date de Paiement -->
    <div>
        <label for="payment_date" class="block font-semibold">Date de paiement :</label>
        <input type="datetime-local" name="payment_date" id="payment_date"
               value="{{ old('payment_date', isset($facture) ? $facture->payment_date : '') }}"
               class="block w-full p-2 border border-gray-300 rounded">
        @error('payment_date')
        <span class="text-red-500 text-md">{{$message}}</span>
        @enderror
    </div>

    <!-- Statut -->
    <div>
        <label for="status" class="block font-semibold">Statut :</label>
        <select name="status" id="status"  class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Sélectionnez un statut</option>
            @foreach(['paye' => 'Payé', 'impaye' => 'Impayé', 'en cours de payement' => 'En cours de paiement'] as $value => $label)
                <option value="{{ $value }}"
                    {{ (isset($facture) && $facture->status == $value) || old('status') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
        <span class="text-red-500 text-md">{{$message}}</span>
        @enderror
    </div>

    <!-- Référence -->
    {{--<div>
        <label for="reference" class="block font-semibold">Référence :</label>
        <input type="text" name="reference" id="reference" maxlength="255"
               value="{{ old('reference', $facture->reference ?? '') }}"
               class="block w-full p-2 border border-gray-300 rounded" placeholder="Entrez la référence (facultatif)">
    </div>--}}

    <!-- Bouton d'Envoi -->
    <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $buttonText }}
        </button>
    </div>
</form>
