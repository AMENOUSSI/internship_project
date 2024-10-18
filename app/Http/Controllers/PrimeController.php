<?php
namespace App\Http\Controllers;

use App\Models\Prime;
use App\Models\Client;
use Illuminate\Http\Request;

class PrimeController extends Controller
{
    public function index()
    {
        $primes = Prime::with('client.assurances.assureur')->paginate(5);
        return view('primes.index', compact('primes'));
    }


    public function create()
    {
        $clients = Client::all();
        return view('primes.form', compact('clients'));
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Prime::create($request->all());

        return redirect()->route('primes.index')->with('success', 'Prime créée avec succès');
    }

    public function edit(Prime $prime)
    {
        $clients = Client::all();
        return view('primes.form', compact('prime', 'clients'));
    }

    public function update(Request $request, Prime $prime)
    {
        $this->validateForm($request);

        $prime->update($request->all());

        return redirect()->route('primes.index')->with('success', 'Prime mise à jour avec succès');
    }

    private function validateForm(Request $request)
    {
        $request->validate([
        'client_id' => 'required|exists:clients,id',
        'prime_nette' => 'required|numeric',
        'assessors' => 'required|numeric',
        'tax' => 'required|numeric',
        ]);
    }

    public function destroy(Prime $prime)
    {
        $prime->delete();
        return redirect()->route('primes.index')->with('success', 'Prime supprimée avec succès');
    }
}
