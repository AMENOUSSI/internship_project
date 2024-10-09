<?php

namespace App\Http\Controllers;

use App\Models\Affaire;
use App\Models\Assureur;
use App\Models\Client;
use App\Models\Police;
use Illuminate\Http\Request;

class PoliceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $affaires = Affaire::all();
        $assureurs = Assureur::all();
        $polices = Police::with(['client', 'assureur', 'affaire'])->get();
        return view('polices.index',compact('polices','clients','affaires','assureurs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $affaires = Affaire::all();
        $assureurs = Assureur::all();
        return view('polices.create',compact('clients','affaires','assureurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'assureur_id' => 'required|exists:assureurs,id',
            'affaire_id' => 'required|exists:affaires,id',
            'assurance_type' => 'required|string',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
            'reference' => 'nullable|string',
        ]);

        Police::updateOrCreate(
            ['id' => $request->id],
            $validated
        );

        return redirect()->route('polices.index')->with('success', 'Police   enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Police $police)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Police $police)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Police $police)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Police $police)
    {
        //
    }
}
