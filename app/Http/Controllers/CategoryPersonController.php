<?php

namespace App\Http\Controllers;

use App\Models\CategoryPerson;
use App\Models\Pays;
use Illuminate\Http\Request;

class CategoryPersonController extends Controller
{
    public function index()
    {
        $categories = CategoryPerson::paginate(10);
        return view('category_person.index', compact('categories'));
    }

    public function create()
    {
        // Récupérer tous les pays dans un format spécifique
        $pays = Pays::all()->map(function ($item) {
            return [
                'code' => strtoupper($item->code),
                'name' => strtoupper($item->name),
                /*'name' => "{$item->name} - {$item->code}"*/
            ];
        });

        return view('category_person.create',compact('pays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        CategoryPerson::create($request->all());

        return redirect()->route('category_people.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(CategoryPerson $categoryPerson)
    {
        return view('category_person.show', compact('categoryPerson'));
    }

    public function edit(CategoryPerson $categoryPerson)
    {
        return view('category_person.edit', compact('categoryPerson'));
    }

    public function update(Request $request, CategoryPerson $categoryPerson)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoryPerson->update($request->all());

        return redirect()->route('category_people.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(CategoryPerson $categoryPerson)
    {
        $categoryPerson->delete();

        return redirect()->route('category_people.index')
            ->with('success', 'Category deleted successfully.');
    }
}
