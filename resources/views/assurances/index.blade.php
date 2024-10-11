@extends('layouts.template')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Liste des Assurances</h1>
        <a href="{{ route('assurances.create') }}" class="bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter une Assurance</a>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Client</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Assureur</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Affaire</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Type</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-left">Date de début</th>
                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm text-center">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @foreach ($assurances as $assurance)
                <tr>
                    <td class="py-3 px-4 text-left">{{ $assurance->client->complete_name }}</td>
                    <td class="py-3 px-4 text-left">{{ $assurance->assureur->name }}</td>
                    <td class="py-3 px-4 text-left">{{ $assurance->affaire->name }}</td>
                    <td class="py-3 px-4 text-left">{{ $assurance->assurance_type }}</td>
                    <td class="py-3 px-4 text-left">{{ Carbon\Carbon::parse($assurance->starting_date)->format('d/m/Y') }}</td>
                    <td class="py-3 px-4 text-center">

                        <a href="{{ route('assurances.edit', $assurance->id) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:ring-primary-300 dark:bg-indigo-900 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>

                        </a>
                        <form action="{{ route('assurances.destroy', $assurance->id) }}" method="POST" id="delete-form" class="inline-block ">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300" data-modal-toggle="delete-user-modal">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @include('category_person.modal')




    <script>
        function toggleModal() {
            const modal = document.getElementById('delete-user-modal');
            modal.classList.toggle('hidden');
        }

        function showDeleteModal(assurancerId) {
            const form = document.getElementById('delete-form');
            form.action = `/assurances/${assurancerId}`; // Assurez-vous que cela correspond à votre route de suppression
            toggleModal();
        }

        function confirmDelete() {
            document.getElementById('delete-form').submit();
        }
    </script>


@endsection
