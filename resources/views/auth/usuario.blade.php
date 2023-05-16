

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <h4 id="error-message"></h4>

        <form method="POST" action="/Cadastrar/Usuario" id="myForm">
            @csrf
            @if(session('error'))
                <div class="alert alert-danger"><p style="color: brown">{{ session('error') }}</p></div>
            @endif
            <div class="mt-4">
                <x-label for="Name" value="{{ __('Nome Completo') }}" />
                <x-input id="Name" class="block mt-1 w-full" type="text" name="Name" :value="old('Name')"
                    required autocomplete="Name" />
            </div>
            <div class="mt-4">
                <x-label for="CPF" value="{{ __('CPF') }}"  id="lbcpf" />
                <x-input id="CPF" class="block mt-1 w-full" type="text" name="CPF"  maxlength="15" 
                autocomplete="CPF" placeholder="__.___.___/____-__" required  />
            </div>
            <div class="mt-4">
                <x-label for="Telefone" value="{{ __('Telefone') }}" />
                <x-input id="Telefone" class="block mt-1 w-full" type="text" name="Telefone" :value="old('Telefone')"
                    required autocomplete="Telefone" />
            </div> <div class="mt-4">
                <x-label for="Celular" value="{{ __('Celular') }}" />
                <x-input id="Celular" class="block mt-1 w-full" type="text" name="Celular" :value="old('Celular')"
                    required autocomplete="Celular" />
            </div>
        </div> <div class="mt-4">
            <x-label for="DT" value="{{ __('Data de Nascimento') }}" />
            <x-input id="DT" class="block mt-1 w-full" type="date" name="DT" :value="old('DT')"
                required autocomplete="DT" />
        </div>
            
            <script>
                var input = document.getElementById("CPF");
            
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
                <button type="submit" class="ml-4">Cadastrar</button>
            </div>
        </form>
      
    </x-authentication-card>
</x-guest-layout>

<script>
    
    const form = document.getElementById("myForm");
    form.addEventListener("submit", function(event)
    {
            event.preventDefault();
            
            return form.submit();

    });
</script>
