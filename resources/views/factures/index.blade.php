@extends('layouts.template')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Liste des Factures</h1>

    <a href="{{ route('factures.create') }}" class="inline-flex items-center px-3 py-2 mb-4 text-sm font-medium text-center text-white rounded-lg bg-blue-900 hover:bg-blue-950 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Creer une nouvelle Facture
    </a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="min-w-full bg-white text-gray-900 shadow rounded dark:bg-gray-700 dark:text-white ">
            <thead class="bg-blue-900 text-gray-100 dark:bg-blue-900 dark:text-white">
            <tr>
                <th class="py-2 px-4 border-b text-left">Ref</th>
                <th class="py-2 px-4 border-b text-left">Client</th>
                <th class="py-2 px-4 border-b text-left">Montant</th>
                <th class="py-2 px-4 border-b text-left">Date d'émission</th>
                <th class="py-2 px-4 border-b text-left">Date de paiement</th>
                <th class="py-2 px-4 border-b text-center">Status</th>
                <th class="py-2 px-4 border-b text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($factures as $facture)
                <tr class="hover:bg-gray-100">
                    <td class="p-3 border border-gray-300">{{ $facture->reference }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $facture->client->complete_name }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $facture->amount }} F CFA</td>
                    <td class="py-2 px-4 border-b text-left">{{\Carbon\Carbon::parse( $facture->emit_date)->format('D d F Y ') }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ \Carbon\Carbon::parse( $facture->payment_date)->format('D d F Y ') }}</td>
                    <td class="py-2 px-4 border-b text-center">
                            <span class="px-2 py-1 rounded-full text-white
                                {{ $facture->status == 'paye' ? 'bg-green-500' : ($facture->status == 'impaye' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($facture->status) }}
                            </span>
                    </td>
                    <td class="p-3 border border-gray-300 space-x-2">
                        <a href="{{ route('factures.show', $facture) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 focus:ring-4 focus:ring-blue-400  dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>

                        </a>
                        <a href="{{ route('factures.edit', $facture->id) }}" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 dark:bg-indigo-900 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>

                        </a>
                        <form action="{{ route('factures.destroy', $facture->id) }}" method="POST" id="delete-form" class="inline-block ">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="showDeleteModal({{ $facture->id }})" class="inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
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
        {{ $factures->links() }}
    </div>

    @include('category_person.modal')

    <script>
        function toggleModal() {
            const modal = document.getElementById('delete-user-modal');
            modal.classList.toggle('hidden');
        }

        function showDeleteModal(factureId) {
            const form = document.getElementById('delete-form');
            form.action = `/factures/${factureId}`; // Assurez-vous que cela correspond à votre route de suppression
            toggleModal();
        }

        function confirmDelete() {
            document.getElementById('delete-form').submit();
        }
    </script>
@endsection
