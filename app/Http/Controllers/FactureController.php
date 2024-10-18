<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('client')->paginate(5);
        return view('factures.index', compact('factures'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('factures.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'emit_date' => 'required|date',
            'payment_date' => 'required|date|after_or_equal:emit_date',
            'status' => 'required|in:paye,impaye,en cours de payement',
            'reference' => 'nullable|string|max:255',
        ]);

        Facture::create($request->all());
        return redirect()->route('factures.index')->with('success', 'Facture ajoutée avec succès');
    }

    public function show(Facture $facture)
    {

        return view('factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        $clients = Client::all();
        return view('factures.edit', compact('facture', 'clients'));
    }

    public function update(Request $request, Facture $facture)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'emit_date' => 'required|date',
            'payment_date' => 'required|date|after_or_equal:emit_date',
            'status' => 'required|in:paye,impaye,en cours de payement',
            'reference' => 'nullable|string|max:255',
        ]);

        $facture->update($request->all());
        return redirect()->route('factures.index')->with('success', 'Facture mise à jour avec succès');
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('factures.index')->with('success', 'Facture supprimée avec succès');
    }
}
