<?php

namespace App\Http\Controllers;

use App\Models\Affaire;
use Illuminate\Http\Request;

class AffaireController extends Controller
{
    public function index()
    {
        $affaires = Affaire::paginate(5);
        return view('affaires.index', compact('affaires'));
    }

    public function create()
    {
        return view('affaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after:starting_date',
            'reference' => 'nullable|string|max:255',
        ]);

        Affaire::create($request->all());

        return redirect()->route('affaires.index')->with('success', 'Affaire créée avec succès.');
    }

    public function show(Affaire $affaire)
    {
        return view('affaires.show', compact('affaire'));
    }

    public function edit(Affaire $affaire)
    {
        return view('affaires.edit', compact('affaire'));
    }

    public function update(Request $request, Affaire $affaire)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after:starting_date',
            'reference' => 'nullable|string|max:255',
        ]);

        $affaire->update($request->all());

        return redirect()->route('affaires.index')->with('success', 'Affaire mise à jour avec succès.');
    }

    public function destroy(Affaire $affaire)
    {
        $affaire->delete();
        return redirect()->route('affaires.index')->with('success', 'Affaire supprimée avec succès.');
    }
}
