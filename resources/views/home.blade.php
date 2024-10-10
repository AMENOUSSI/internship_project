@extends('layouts.template')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Two factor authentication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-6">
                <div class="max-w-4xl space-y-10">
                    <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('L\'authentification à deux facteurs (2FA)') }}
                    </div>

                    <div class="mt-4">
                        @if (! auth()->user()->two_factor_secret)
                            <p class="text-neutral-800 dark:text-gray-300 mt-4">
                                {{ __("Vous n'avez pas activé l'authentification à deux facteurs.") }}
                            </p>

                            {{-- Form to enable 2FA --}}
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                                @csrf
                                <x-primary-button class="mt-4">
                                    {{ __('Activer') }}
                                </x-primary-button>
                            </form>
                        @else
                            <p class="text-neutral-600 dark:text-gray-300 mt-4">
                                {{ __("Vous avez activé l'authentification à deux facteurs.") }}
                            </p>

                            {{-- Form to disable 2FA --}}
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="mt-4">
                                    {{ __('Désactiver') }}
                                </x-danger-button>
                            </form>
                        @endif
                    </div>

                    <div class="mt-4">
                        @if(session('status') == 'two-factor-authentication-enabled')
                            <p class="text-neutral-600 dark:text-gray-300">
                                {{ __("Vous avez maintenant activé l'authentification à deux facteurs (2FA). Veuillez scanner le code QR suivant dans votre application d'authentification.") }}
                            </p>

                            {{-- Show QR code --}}
                            <div class="mt-4">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>

                            <p class="text-neutral-600 dark:text-gray-300 mt-4">
                                {{ __('Veuillez conserver ces codes de récupération dans un endroit sûr.') }}
                            </p>

                            <ul class="list-disc list-inside text-neutral-600 dark:text-gray-300 mt-4">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                                    <li class="my-1">{{ trim($code) }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
