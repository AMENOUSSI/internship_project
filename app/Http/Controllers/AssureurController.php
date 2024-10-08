<?php

namespace App\Http\Controllers;

use App\Models\Assureur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssureurController extends Controller
{
    public function index()
    {
        $assureurs = Assureur::all();
        return view('assureurs.index', compact('assureurs'));
    }

    public function create()
    {
        return view('assureurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:assureurs,name',
        ]);

        /*Assureur::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);*/
        Assureur::create($request->all());

        return redirect()->route('assureurs.index');
    }

    public function edit(Assureur $assureur)
    {
        return view('assureurs.create', compact('assureur'));
    }

    public function update(Request $request, Assureur $assureur)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:assureurs,name,' . $assureur->id,
        ]);

        $assureur->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('assureurs.index');
    }

    public function destroy(Assureur $assureur)
    {
        $assureur->delete();
        return redirect()->route('assureurs.index');
    }
}
