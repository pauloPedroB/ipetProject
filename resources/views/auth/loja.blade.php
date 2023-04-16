

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="/Cadastrar/Loja">
            @csrf

            <div class="mt-4">
                <x-label for="name" value="{{ __('Nome da Loja') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="cnpj" value="{{ __('CNPJ') }}" />
                <x-input id="cnpj" class="block mt-1 w-full" type="text" name="cnpj"  maxlength="15" 
                autocomplete="cnpj" placeholder="__.___.___/____-__" required  />
            </div>
            <script>
                var input = document.getElementById("cnpj");
            
                input.addEventListener("keydown", function(event) {
                    // Permite apenas números
                    if (!((event.keyCode >= 48 && event.keyCode <= 57) || 
                        (event.keyCode >= 96 && event.keyCode <= 105) || 
                        event.keyCode == 8 || event.keyCode == 9 || 
                        event.keyCode == 13 || event.keyCode == 27 || 
                        event.keyCode == 46 || event.keyCode == 110 || 
                        event.keyCode == 190)) {
                        event.preventDefault();
                    }
                });
            </script>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Já tem cadastrado?') }}
                </a>

                <x-button class="ml-4" id="sub">
                    {{ __('Cadastrar') }}
                </x-button>
            </div>
        </form>
        {{-- <x-button class="ml-4" onclick="javascript:validarCnpj()" id="valide">
            {{ __('Validar CNPJ') }}
        </x-button>
    --}}
    </x-authentication-card>
</x-guest-layout>
