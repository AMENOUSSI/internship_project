@extends('layouts.template')

@section('content')
    <div class="container mx-auto text-gray-950 bg-white dark:text-white  dark:bg-gray-900 p-8 rounded">
        <h1 class="text-3xl font-bold mb-6">{{ isset($assureur) ? 'Modifier' : 'Ajouter' }} un Assureur</h1>

        <form action="{{ isset($assureur) ? route('assureurs.update', $assureur->id) : route('assureurs.store') }}" method="POST">
            @csrf
            @if(isset($assureur))
                @method('PUT')
            @endif

            <div class="mb-2">
                <label for="name" class="block text-black">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $assureur->name ?? '') }}" class="dark:bg-gray-800 dark:text-gray-300 w-full p-2 rounded" oninput="generateSlug()">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-black">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $assureur->slug ?? '') }}" class=" dark:bg-gray-800 dark:text-gray-300 w-full p-2 rounded" readonly>
            </div>

            <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">{{ isset($assureur) ? 'Modifier' : 'Ajouter' }}</button>
            <a href="{{ route('assureurs.index') }}" class=" bg-gray-200 py-2 px-4 hover:bg-gray-400 rounded ml-4">Annuler</a>
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
