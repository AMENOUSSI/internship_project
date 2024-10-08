<x-app-layout>
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
                        {{ __('2FA Authentication') }}
                    </div>

                    <div class="mt-4">
                        @if (! auth()->user()->two_factor_secret)
                            <p class="text-neutral-800 dark:text-gray-300 mt-4">
                                {{ __('You have not enabled 2FA') }}
                            </p>

                            {{-- Form to enable 2FA --}}
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                                @csrf
                                <x-primary-button class="mt-4">
                                    {{ __('Enable') }}
                                </x-primary-button>
                            </form>
                        @else
                            <p class="text-neutral-600 dark:text-gray-300 mt-4">
                                {{ __('You have enabled 2FA.') }}
                            </p>

                            {{-- Form to disable 2FA --}}
                            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="mt-4">
                                    {{ __('Disable') }}
                                </x-danger-button>
                            </form>
                        @endif
                    </div>

                    <div class="mt-4">
                    @if(session('status') == 'two-factor-authentication-enabled')
                            <p class="text-neutral-600 dark:text-gray-300">
                                {{ __('You have now enabled 2FA, please scan the following QR code into your authenticator application.') }}
                            </p>

                            {{-- Show QR code --}}
                            <div class="mt-4">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>

                            <p class="text-neutral-600 dark:text-gray-300 mt-4">
                                {{ __('Please store these recovery codes in a secure location:') }}
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
</x-app-layout>
