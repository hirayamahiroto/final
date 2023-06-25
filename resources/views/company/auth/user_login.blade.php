<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('company.user_login') }}">
        @csrf

        <!-- CoåmpanyID -->
        {{-- <div>
            <x-input-label for="company_id" :value="__('Company ID')" />
            <x-text-input id="company_id" class="block mt-1 w-full" type="text" name="company_id" :value="old('company_id')" required autofocus autocomplete="company_id" />
            <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
        </div> --}}

        <div>
            <x-input-label for="company_id" :value="__('Company ID')" />
            <x-text-input id="company_id" class="block mt-1 w-full" type="number" name="company_id" :value="old('company_id')" required autofocus autocomplete="company_id" />
            <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            @if (Route::has('company.password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('company.password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
