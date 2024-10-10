<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pays;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(8);;
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $pays = Pays::all();
        return view('clients.create', compact('pays'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'type_client' => 'required|string|max:255',
            'email' => 'nullable|email',
            'created_date' => 'required|date',
            'phone_number' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Femme,Homme',
            'comment' => 'nullable|string',
            'reference' => 'nullable|unique|string',
            'pays_id' => 'required|exists:pays,id'
        ]);

        Client::create($validated);
        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function show($id)
    {
        $client = Client::with('pays')->findOrFail($id);

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $pays = Pays::all();
        return view('clients.edit', compact('client', 'pays'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'type_client' => 'required|string|max:255',
            'email' => 'nullable|email',
            'created_date' => 'required|date',
            'phone_number' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Femme,Homme',
            'comment' => 'nullable|string',
            'reference' => 'nullable|unique|string',
            'pays_id' => 'required|exists:pays,id'
        ]);

        $client->update($validated);
        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
