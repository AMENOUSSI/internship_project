<?php

namespace App\Http\Controllers;

use App\Models\Prime;
use App\Models\Client;
use App\Models\Police;
use Illuminate\Http\Request;

class PrimeController extends Controller
{
    public function index()
    {
        $primes = Prime::with('client', 'police')->get();
        $clients = Client::all();
        $polices = Police::all();

        return view('primes.index', compact('primes', 'clients', 'polices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'police_id' => 'required|exists:police,id',
            'prime_nette' => 'required|numeric',
            'assessors' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);

        Prime::create($request->all());

        return redirect()->route('primes.index')->with('success', 'Prime créée avec succès.');
    }

    public function edit(Prime $prime)
    {
        $clients = Client::all();
        $polices = Police::all();

        return response()->json([
            'prime' => $prime,
            'clients' => $clients,
            'polices' => $polices,
        ]);
    }

    public function update(Request $request, Prime $prime)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'police_id' => 'required|exists:police,id',
            'prime_nette' => 'required|numeric',
            'assessors' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);

        $prime->update($request->all());

        return redirect()->route('primes.index')->with('success', 'Prime mise à jour avec succès.');
    }

    public function destroy(Prime $prime)
    {
        $prime->delete();
        return redirect()->route('primes.index')->with('success', 'Prime supprimée avec succès.');
    }
}
