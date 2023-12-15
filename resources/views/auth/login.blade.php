<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
            <img src="{{ asset('utills/dist/assets/media/logos/cogent_new_logo.png') }}" width="250" height="150" alt="Cogent">
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif


        <form method="POST" action="{{ route('Custome_Login') }}">
            @csrf

            <div>
                <x-label for="EmployeeID" value="{{ __('EmployeeID') }}" />
                <x-input id="EmployeeID" class="block mt-1 w-full" type="text" name="LoginId" :value="old('LoginId')" required autofocus autocomplete="EmployeeID" />
            </div>
            <input type="text" hidden value="ces" name="appkey">

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="refrance" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

            </div>
            <div class="alert" id="toaster-message" style="display: none; color:red;margin-left: 15rem;"></div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toasterMessage = document.getElementById('toaster-message');
                const queryParams = new URLSearchParams(window.location.search);
                const errorMessage = queryParams.get('error');

                if (errorMessage) {
                    toasterMessage.textContent = errorMessage;
                    toasterMessage.style.display = 'block';
                }
            });
        </script>

    </x-authentication-card>
</x-guest-layout>