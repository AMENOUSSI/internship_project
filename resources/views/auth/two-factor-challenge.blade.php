<x-guest-layout>
    <div class="mb-4 text-2xl font-bold text-gray-600 dark:text-gray-400">
        {{ __('Please enter your authentication code to login')}}
    </div>

    @if(session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif


    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="code" :value="__('Code')"/>
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" required/>
            <x-input-error  :messages="$errors->get('code')" class="mt-2"/>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </div>
    </form>
    <p>Use your recovery code</p>
    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="recovery_code" :value="__('Code')"/>
            <x-text-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" required/>
            <x-input-error  :messages="$errors->get('recovery_code')" class="mt-2"/>


            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </div>
    </form>

</x-guest-layout>
