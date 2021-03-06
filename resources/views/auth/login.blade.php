<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img style="width:120px;border-radius: 15px !important;" src='{{asset("assets\logo.png")}}'>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div style="padding-bottom:15px;">
                <h5><b>Login</b></h5>
            </div>
            <div>
                <!-- <x-jet-label for="email" value="{{ __('Email') }}" /> -->
                <x-jet-input id="email" placeholder="{{ __('E-mail') }}" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="password" value="{{ __('Password') }}" /> -->
                <x-jet-input id="password"  placeholder="{{ __('Senha') }}" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
                </label>
            </div>
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Esqueceu a senha?') }}
                    </a>
                    @endif
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition rounded-pill" href="https://serradobene.com" style="text-decoration:none;background-color:#71BF94; color:white;">
                    {{ __('Voltar') }}
                </a>

                <x-jet-button style="background-color:#71BF94; color:white;margin-left:10px;" class="rounded-pill">
                    {{ __('Entrar') }}
                </x-jet-button>
            
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
