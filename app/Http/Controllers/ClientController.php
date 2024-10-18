<?php

namespace App\Http\Controllers;

use App\Models\CategoryPerson;
use App\Models\Client;
use App\Models\Pays;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(5);;
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $categories = CategoryPerson::all();
        $pays = Pays::all();
        return view('clients.create', compact('pays','categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'type' => 'required|in:Personne morale,Personne physique',
            'email' => 'nullable|email',
            'created_date' => 'required|date',
            'adresse' => 'required|string',
            'phone_number' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Femme,Homme',
            'comment' => 'nullable|string',
            'reference' => 'nullable|unique|string',
            'category_people_id' => 'required|exists:category_people,id',
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
        $categories = CategoryPerson::all();
        $pays = Pays::all();
        return view('clients.create', compact('client', 'pays','categories'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'type' => 'required|in:Personne morale,Personne physique',
            'email' => 'nullable|email',
            'created_date' => 'required|date',
            'adresse' => 'required|string',
            'phone_number' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Femme,Homme',
            'comment' => 'nullable|string',
            'reference' => 'nullable|unique|string',
            'category_people_id' => 'required|exists:category_people,id',
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
