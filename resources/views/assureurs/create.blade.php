@extends('layouts.template')

@section('content')
    <div class="container mx-auto text-white bg-gray-400 dark:text-gray-100 dark:bg-gray-900 p-8 rounded">
        <h1 class="text-3xl font-bold mb-6">{{ isset($assureur) ? 'Modifier' : 'Ajouter' }} un Assureur</h1>

        <form action="{{ isset($assureur) ? route('assureurs.update', $assureur->id) : route('assureurs.store') }}" method="POST">
            @csrf
            @if(isset($assureur))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-300">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $assureur->name ?? '') }}" class="bg-gray-800 text-gray-300 w-full p-2 rounded" oninput="generateSlug()">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-gray-300">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $assureur->slug ?? '') }}" class="bg-gray-800 text-gray-300 w-full p-2 rounded" readonly>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">{{ isset($assureur) ? 'Modifier' : 'Ajouter' }}</button>
            <a href="{{ route('assureurs.index') }}" class="text-gray-400 underline ml-4">Annuler</a>
        </form>
    </div>

    <script>
        function generateSlug() {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');
            const initials = nameInput.value.trim().split(/\s+/).map(word => word[0]).join('').toUpperCase();

            // Mettre à jour le champ slug
            slugInput.value = initials;
        }
    </script>
@endsection
