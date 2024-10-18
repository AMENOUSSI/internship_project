<?php

namespace App\Http\Controllers;

use App\Models\Police;
use App\Models\Client;
use App\Models\Assureur;
use App\Models\Affaire;
use App\Models\Assurance;
use Illuminate\Http\Request;

class PoliceController extends Controller
{
    public function index()
    {
        $polices = Police::with(['client', 'assureur', 'affaire', 'assurance'])->paginate(5);
        return view('polices.index', compact('polices'));
    }

    public function create()
    {
        $clients = Client::all();
        $assureurs = Assureur::all();
        $affaires = Affaire::all();
        $assurances = Assurance::all();
        return view('polices.create', compact('clients', 'assureurs', 'affaires', 'assurances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'assureur_id' => 'required',
            'affaire_id' => 'required',
            'assurance_id' => 'required',
            'starting_date' => 'required|date',
            'ending_date' => 'nullable|date',
            'reference' => 'nullable|string|max:255'
        ]);

        Police::create($request->all());

        return redirect()->route('polices.index')->with('success', 'Police ajoutée avec succès.');
    }

    public function edit(Police $police)
    {
        $clients = Client::all();
        $assureurs = Assureur::all();
        $affaires = Affaire::all();
        $assurances = Assurance::all();
        return view('polices.edit', compact('police', 'clients', 'assureurs', 'affaires', 'assurances'));
    }

    public function update(Request $request, Police $police)
    {
        $request->validate([
            'client_id' => 'required',
            'assureur_id' => 'required',
            'affaire_id' => 'required',
            'assurance_id' => 'required',
            'starting_date' => 'required|date',
            'ending_date' => 'nullable|date',
            'reference' => 'nullable|string|max:255'
        ]);

        $police->update($request->all());

        return redirect()->route('polices.index')->with('success', 'Police mise à jour avec succès.');
    }

    public function destroy(Police $police)
    {
        $police->delete();
        return redirect()->route('polices.index')->with('success', 'Police supprimée avec succès.');
    }
}
