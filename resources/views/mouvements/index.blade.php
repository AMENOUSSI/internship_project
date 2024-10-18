@extends('layouts.template')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-black dark:text-gray-400 text-2xl font-bold mb-4">Mouvements de Police</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('mouvements.create') }}" class="inline-flex items-center text-md px-3 py-2 mb-4  font-medium text-center text-gray-200 rounded-lg bg-blue-900 hover:bg-blue-950 focus:ring-4 focus:ring-primary-300 dark:bg-blue-900 dark:hover:bg-blue-950 dark:focus:ring-primary-800">
            <svg class="w-6 h-6 text-gray-100 mr-2 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            Ajouter un nouveau mouvement
        </a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-md text-left rtl:text-right  dark:text-gray-400 dark:bg-gray-700  font-playfair">
                <thead class="text-xs text-gray-200 uppercase bg-blue-900 dark:bg-blue-950 dark:text-gray-400">
                <tr>
                    <th class="py-2 px-4 ">Ref</th>
                    <th class="py-2 px-4 ">Type de Police</th>
                    <th class="py-2 px-4 ">Client</th>
                    <th class="py-2 px-4 ">Date de début</th>
                    <th class="py-2 px-4 ">Date de fin</th>
                    <th class="py-2 px-4 ">Commentaire</th>
                    <th class="py-2 px-4 border-b text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mouvements as $mouvement)
                    <tr>
                        <td class="py-2 px-4">{{ $mouvement->reference }}</td>
                        <td class="py-2 px-4">{{ $mouvement->type }}</td>
                        <td class="py-2 px-4">{{ $mouvement->client->complete_name }}</td>
                        <td class="py-2 px-4">{{ $mouvement->starting_date }}</td>
                        <td class="py-2 px-4">{{ $mouvement->ending_date }}</td>
                        <td class="py-2 px-4">{{ $mouvement->comment }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('mouvements.show', $mouvement) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 focus:ring-4 focus:ring-blue-400  dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>

                            </a>
                                <a href="{{ route('mouvements.edit', $mouvement->id) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 dark:bg-indigo-900 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>

                                </a>
                            <form action="{{ route('mouvements.destroy', $mouvement->id) }}" method="POST" id="delete-form" class="inline-block ">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showDeleteModal({{ $mouvement->id }})" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
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
        <div class="mt-4">
            {{ $mouvements->links() }}
        </div>
    </div>

    @include('category_person.modal')




    <script>
        function toggleModal() {
            const modal = document.getElementById('delete-user-modal');
            modal.classList.toggle('hidden');
        }

        function showDeleteModal(mouvementId) {
            const form = document.getElementById('delete-form');
            form.action = `/mouvements/${mouvementId}`; // Assurez-vous que cela correspond à votre route de suppression
            toggleModal();
        }

        function confirmDelete() {
            document.getElementById('delete-form').submit();
        }
    </script>
@endsection



