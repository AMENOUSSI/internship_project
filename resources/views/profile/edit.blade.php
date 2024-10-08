@extends('layouts.template')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="text-lg font-medium text-blue-950 dark:text-gray-100 my-2">2FA Authentication</div>
                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="mb-4 font-bold text-blue-950">
                            Please finish configuring two factor authentication below.
                        </div>
                    @endif
                    @if (session('status') == 'two-factor-authentication-disabled')
                        <div class="mb-4 font-medium text-sm">
                            Two factor authentication disabled.
                        </div>
                    @endif
                    @if (session('status') == 'two-factor-authentication-confirmed')
                        <div class="mb-4 font-medium text-sm">
                            Two factor authentication confirmed and enabled successfully.
                        </div>
                    @endif
                    {{--Show QR code here--}}
                    @if(auth()->user()->two_factor_secret)
                        <div>
                            <div class="container flex justify-center">
                                <div class="inline-block p-4 bg-white shadow-lg rounded-lg">
                                    <div class="inline-block">
                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                </div>
                            </div>

                            <br>
                            <p class="mb-4 font-bold text-blue-900">Please store theses recovery codes in a secure location.</p>
                            @foreach(json_decode((decrypt(auth()->user()->two_factor_recovery_codes,true))) as $code)
                                <ul>
                                    <li>{{ trim($code) }}</li>
                                </ul>
                            @endforeach
                        </div>
                    @endif
                    {{--function enabled 2FA--}}
                    @if(!auth()->user()->two_factor_secret)
                        <form  method="POST" action="/user/two-factor-authentication">
                            @csrf
                            <x-primary-button class="my-2">
                                {{__('Enabled')}}
                            </x-primary-button>
                        </form>
                    @else
                        {{--Button disabled --}}
                        <form  method="POST" action="/user/two-factor-authentication">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="my-2">
                                {{__('Disabled')}}
                            </x-danger-button>
                        </form>
                    @endif

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
