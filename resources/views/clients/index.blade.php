@extends('layouts.template')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Liste des Clients</h1>
        <a href="{{ route('clients.create') }}" class="inline-flex items-center px-3 py-2 mb-4 text-sm font-medium text-center text-white rounded-lg bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            Creer un client
        </a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="min-w-full bg-white text-gray-900 shadow rounded-lg dark:bg-gray-700 dark:text-white font-playfair">
                <thead class="bg-blue-800 text-gray-100 dark:bg-blue-900 dark:text-white">
                <tr>
                    <th class="py-2 px-4 border-b text-left">Reference</th>
                    <th class="py-2 px-4 border-b">Nom Complet</th>
                    <th class="py-2 px-4 border-b">Type de client</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Date de Création</th>
                    <th class="py-2 px-4 border-b">Téléphone</th>
                    <th class="py-2 px-4 border-b">Adresse</th>
                    <th class="py-2 px-4 border-b">Pays</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-left">{{ $client->reference }}</td>
                        <td class="py-2 px-4">{{ $client->complete_name }}</td>
                        <td class="py-2 px-4">{{ $client->type }}</td>
                        <td class="py-2 px-4">{{ $client->email }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($client->created_date)->format('d M,Y') }}</td>
                        <td class="py-2 px-4">{{ $client->phone_number }}</td>
                        <td class="py-2 px-4">{{ $client->adresse  }}</td>
                        <td class="py-2 px-4">{{ $client->pays->name  }}</td>

                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('clients.edit', $client->id) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 dark:bg-indigo-900 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>

                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" id="delete-form" class="inline-block ">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showDeleteModal({{ $client->id }})" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
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
        <div class="mt-2">
            {{ $clients->links() }}
        </div>
    </div>

    @include('category_person.modal')
    <script>
        function toggleModal() {
            const modal = document.getElementById('delete-user-modal');
            modal.classList.toggle('hidden');
        }

        function showDeleteModal(clientId) {
            const form = document.getElementById('delete-form');
            form.action = `/clients/${clientId}`; // Assurez-vous que cela correspond à votre route de suppression
            toggleModal();
        }

        function confirmDelete() {
            document.getElementById('delete-form').submit();
        }
    </script>

@endsection



