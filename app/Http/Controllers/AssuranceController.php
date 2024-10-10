<?php
namespace App\Http\Controllers;

use App\Models\Assurance;
use App\Models\Client;
use App\Models\Assureur;
use App\Models\Affaire;
use Illuminate\Http\Request;

class AssuranceController extends Controller
{
    public function index()
    {
        $assurances = Assurance::with('client', 'assureur', 'affaire')->get();
        return view('assurances.index', compact('assurances'));
    }

    public function create()
    {
        $clients = Client::all();
        $assureurs = Assureur::all();
        $affaires = Affaire::all();
        return view('assurances.create', compact('clients', 'assureurs', 'affaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'client_id' => 'required',
        'assureur_id' => 'required',
        'affaire_id' => 'required',
        'assurance_type' => 'required|string',
        'starting_date' => 'required|date',
        'ending_date' => 'required|date',
        'reference' => 'nullable|string',
        ]);

        Assurance::create($request->all());

        return redirect()->route('assurances.index')->with('success', 'Assurance créée avec succès.');
    }

    public function show(Assurance $assurance)
    {
        return view('assurances.show', compact('assurance'));
    }

    public function edit(Assurance $assurance)
    {
        $clients = Client::all();
        $assureurs = Assureur::all();
        $affaires = Affaire::all();
        return view('assurances.edit', compact('assurance', 'clients', 'assureurs', 'affaires'));
    }

    public function update(Request $request, Assurance $assurance)
    {
        $request->validate([
        'client_id' => 'required',
        'assureur_id' => 'required',
        'affaire_id' => 'required',
        'assurance_type' => 'required|string',
        'starting_date' => 'required|date',
        'ending_date' => 'required|date',
        'reference' => 'nullable|string',
        ]);

        $assurance->update($request->all());

        return redirect()->route('assurances.index')->with('success', 'Assurance mise à jour avec succès.');
}

    public function destroy(Assurance $assurance)
    {
        $assurance->delete();
        return redirect()->route('assurances.index')->with('success', 'Assurance supprimée avec succès.');
    }
}
