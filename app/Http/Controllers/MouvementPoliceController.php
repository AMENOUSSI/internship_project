<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\MouvementPolice;
use App\Models\Police;
use Illuminate\Http\Request;

class MouvementPoliceController extends Controller
{
    public function index()
    {
        $mouvements = MouvementPolice::with('client')->paginate(5);
        return view('mouvements.index', compact('mouvements'));
    }

    public function create()
    {
        $polices = Police::all();
        $clients = Client::all(); // Récupérer tous les clients
        return view('mouvements.form', compact('clients','polices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:renouvellement,incorporation,retrait',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
            'comment' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',

        ]);

        MouvementPolice::create($request->all());
        return redirect()->route('mouvements.index')->with('success', 'Mouvement ajouté avec succès.');
    }

    public function show(MouvementPolice $mouvement)
    {
        return view('mouvements.show', compact('mouvement'));
    }

    public function edit(MouvementPolice $mouvement)
    {
        $polices = Police::all();
        $clients = Client::all(); // Récupérer tous les clients
        return view('mouvements.form', compact('mouvement', 'clients','polices'));
    }

    public function update(Request $request, MouvementPolice $mouvement)
    {
        $request->validate([
            'type' => 'required|in:renouvellement,incorporation,retrait',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
            'comment' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
        ]);

        $mouvement->update($request->all());
        return redirect()->route('mouvements.index')->with('success', 'Mouvement mis à jour avec succès.');
    }

    public function destroy(MouvementPolice $mouvement)
    {
        $mouvement->delete();
        return redirect()->route('mouvements.index')->with('success', 'Mouvement supprimé avec succès.');
    }
}
