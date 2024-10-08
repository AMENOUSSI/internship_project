@extends('layouts.template')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">Category Details</h2>

        <div class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <p class="text-gray-700 font-bold">ID:</p>
                <p>{{ $categoryPerson->id }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-700 font-bold">Name:</p>
                <p>{{ $categoryPerson->name }}</p>
            </div>

            <a href="{{ route('category_people.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4 inline-block">Back to Categories</a>
        </div>
    </div>
@endsection
