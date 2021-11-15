<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src='{{asset("assets\logo.png")}}'>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div style="padding-bottom:15px;">
                <h5><b>Cadastro</b></h5>
            </div>
            <div class="hidden">
                <x-jet-label for="id_tipo_usuario" value="{{ __('Tipo usuário') }}" />
                
                <select id="id_tipo_usuario" class="block mt-1 w-full" name="id_tipo_usuario" :value="old('id_tipo_usuario')" required autofocus>

                    <option value="1">
                        Administrador
                    </option>
                    <option value="2" selected>
                        Simples
                    </option>

                </select>
            </div>
            
            <div>
                <!-- <x-jet-label for="name" value="{{ __('Nome') }}" /> -->
                <x-jet-input id="name" placeholder="Nome *" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="telefone" value="{{ __('Telefone') }}" /> -->
                <x-jet-input id="telefone" placeholder="Telefone *" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" required />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="email" value="{{ __('Email') }}" /> -->
                <x-jet-input id="email" placeholder="E-mail *" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="password" value="{{ __('Senha') }}" /> -->
                <x-jet-input id="password" placeholder="Senha *" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="password_confirmation" value="{{ __('Confirme a senha') }}" /> -->
                <x-jet-input id="password_confirmation" placeholder="Confirmar senha *" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'._('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'._('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="items-center text-center mt-4">
                <x-jet-button style="background-color:#71BF94; color:white;" class="rounded-pill">
                    {{ __('Cadastrar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>