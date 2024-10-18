@extends('layouts.template')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">{{ isset($prime) ? 'Éditer' : 'Créer' }} une Prime</h1>

        <form action="{{ isset($prime) ? route('primes.update', $prime->id) : route('primes.store') }}" method="POST">
            @csrf
            @if(isset($prime))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="client_id" class="block">Client</label>
                <select name="client_id" id="client_id" class="w-full border border-gray-300 p-2 rounded">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ isset($prime) && $prime->client_id == $client->id ? 'selected' : '' }}>{{ $client->complete_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="prime_nette" class="block">Prime Nette</label>
                <input type="number" name="prime_nette" id="prime_nette" step="0.01" value="{{ $prime->prime_nette ?? old('prime_nette') }}" class="w-full border border-gray-300 p-2 rounded" oninput="calculateTotal()">
            </div>

            <div class="mb-4">
                <label for="assessors" class="block">Assessors</label>
                <input type="number" name="assessors" id="assessors" step="0.01" value="{{ $prime->assessors ?? old('assessors') }}" class="w-full border border-gray-300 p-2 rounded" oninput="calculateTotal()">
            </div>

            <div class="mb-4">
                <label for="tax" class="block">Taxe</label>
                <input type="number" name="tax" id="tax" step="0.01" value="{{ $prime->tax ?? old('tax') }}" class="w-full border border-gray-300 p-2 rounded" oninput="calculateTotal()">
            </div>

            <div class="mb-4">
                <label for="total" class="block">Total</label>
                <input type="number" name="total" id="total" step="0.01" value="{{ $prime->total ?? old('total') }}" class="w-full border border-gray-300 p-2 rounded" readonly>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('primes.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded">Retour</a>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">
                    {{ isset($prime) ? 'Mettre à jour' : 'Créer' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotal() {
            const primeNette = parseFloat(document.getElementById('prime_nette').value) || 0;
            const assessors = parseFloat(document.getElementById('assessors').value) || 0;
            const tax = parseFloat(document.getElementById('tax').value) || 0;

            const total = primeNette + assessors + tax;
            document.getElementById('total').value = total.toFixed(2);
        }
    </script>
@endsection
