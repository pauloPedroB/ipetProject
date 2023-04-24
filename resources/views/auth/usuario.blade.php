

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <h4 id="error-message"></h4>

        <form method="POST" action="/Cadastrar/Usuario" id="myForm">
            @csrf
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Já tem cadastrado?') }}
                </a>

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
            const msg = document.getElementById('error-message');
            const cpf = document.getElementById('CPF').value;

            let soma = 0;
            let resto;

            if (cpf == "000.000.000-00" || cpf == "111.111.111-11" || cpf == "222.222.222-22" ||
                cpf == "333.333.333-33" || cpf == "444.444.444-44" || cpf == "555.555.555-55" ||
                cpf == "666.666.666-66" || cpf == "777.777.777-77" || cpf == "888.888.888-88" ||
                cpf == "999.999.999-99") {
                msg.innerText = 'CPF INVÁLIDO!!'
                msg.style.color='red';
                document.getElementById('lbcpf').style.color='red';
                return;
            }

            for (i = 1; i <= 9; i++) {
                soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
            }
            resto = (soma * 10) % 11;

            if ((resto == 10) || (resto == 11)) {
                resto = 0;
            }

            if (resto != parseInt(cpf.substring(9, 10))) {
                msg.innerText = 'CPF INVÁLIDO!!'
                msg.style.color='red';
                document.getElementById('lbcpf').style.color='red';
                return;
            }

            soma = 0;

            for (i = 1; i <= 10; i++) {
                soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
            }
            resto = (soma * 10) % 11;

            if ((resto == 10) || (resto == 11)) {
                resto = 0;
            }

            if (resto != parseInt(cpf.substring(10, 11))) {
                msg.innerText = 'CPF INVÁLIDO!!'
                msg.style.color='red';
                document.getElementById('lbcpf').style.color='red';
                return;
            }
            return form.submit();

    });
</script>
