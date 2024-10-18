<?php

namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Assureur;
use App\Models\Client;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::with('client', 'assurance', 'assureur')->paginate(5);
        return view('commissions.index', compact('commissions'));
    }

    public function create()
    {
        $clients = Client::all();
        $assurances = Assurance::all();
        $assureurs = Assureur::all();
        return view('commissions.form', compact('clients', 'assurances', 'assureurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assurance_id' => 'required|exists:assurances,id',
            'assureur_id' => 'required|exists:assureurs,id',
            'taux' => 'required|string',
        ]);

        Commission::create($request->all());
        return redirect()->route('commissions.index')->with('success', 'Commission créée avec succès.');
    }

    public function show(Commission $commission)
    {
        return view('commissions.show', compact('commission'));
    }

    public function edit(Commission $commission)
    {
        $clients = Client::all();
        $assurances = Assurance::all();
        $assureurs = Assureur::all();
        return view('commissions.form', compact('commission', 'clients', 'assurances', 'assureurs'));
    }

    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assurance_id' => 'required|exists:assurances,id',
            'assureur_id' => 'required|exists:assureurs,id',
            'taux' => 'required|string',
        ]);

        $commission->update($request->all());
        return redirect()->route('commissions.index')->with('success', 'Commission mise à jour avec succès.');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();
        return redirect()->route('commissions.index')->with('success', 'Commission supprimée avec succès.');
    }
}
