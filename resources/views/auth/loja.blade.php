

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <h4 id="error-message"></h4>

        <form method="POST" action="/Cadastrar/Loja" id="myForm">
            @csrf

            <div class="mt-4">
                <x-label for="name" value="{{ __('Nome da Loja') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="cnpj" value="{{ __('CNPJ') }}"  id="lbcnpj" />
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
        const cnpj = document.getElementById('cnpj').value.replace(/[^\d]+/g,'');

        if (cnpj == '') {
            msg.innerText = 'CNPJ INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }

        if (cnpj.length != 14) {
            msg.innerText = 'CNPJ INVÁLIDO!!';
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }

        // Validação do primeiro dígito verificador
        let soma = 0;
        let multiplicador = 2;

        for (let i = 11; i >= 0; i--) {
            soma += parseInt(cnpj.charAt(i)) * multiplicador;
            multiplicador = multiplicador == 9 ? 2 : multiplicador + 1;
        }

        const resto = soma % 11;
        const digitoVerificador1 = resto < 2 ? 0 : 11 - resto;

        if (parseInt(cnpj.charAt(12)) != digitoVerificador1) {
            msg.innerText = 'CNPJ INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }

        // Validação do segundo dígito verificador
        soma = 0;
        multiplicador = 2;

        for (let i = 12; i >= 0; i--) {
            soma += parseInt(cnpj.charAt(i)) * multiplicador;
            multiplicador = multiplicador == 9 ? 2 : multiplicador + 1;
        }

        const digitoVerificador2 = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if (parseInt(cnpj.charAt(13)) != digitoVerificador2) {
            msg.innerText = 'CNPJ INVÁLIDO!!'
            msg.style.color='red';
            document.getElementById('lbcnpj').style.color='red';
            return;
        }
        document.getElementById("cnpj").readOnly = true;
        if(document.getElementById("name").length < 7){
            msg.innerText = 'NOME INVÁLIDO!!'
            document.getElementById("name").style.color = 'red';
            return msg.style.color='red';
        }

    
        return form.submit();

    });
</script>
