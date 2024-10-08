@extends('layouts.template')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">Edit Category</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category_people.update', $categoryPerson->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ $categoryPerson->name }}" class="w-full border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
