<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Antes de continuar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos o prazer de lhe enviar outro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu nas configurações do seu perfil.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <div id="tempoRestante"></div>
                    <x-button type="submit" id="meuBotao" onclick="clicouBotao()">
                        {{ __('Reenviar Email de Verificação') }}
                    </x-button>
                    <script>
                        function clicouBotao() 
                        {
                            // Desativa o botão
                            document.getElementById("meuBotao").disabled = true;

                            // Define o tempo total de espera em milissegundos
                            var tempoTotal = 30000;

                            // Exibe a contagem regressiva
                            var tempoRestante = tempoTotal / 1000;
                            document.getElementById("tempoRestante").innerHTML = "Aguarde " + tempoRestante + " segundos...";

                            // Define o intervalo de atualização da contagem regressiva em milissegundos
                            var intervalo = 1000;

                            // Atualiza a contagem regressiva a cada intervalo
                            var atualizarTempo = setInterval(function() {
                                tempoRestante--;
                                document.getElementById("tempoRestante").innerHTML = "Aguarde " + tempoRestante + " segundos...";
                            }, intervalo);

                            // Reativa o botão após o tempo total de espera
                            setTimeout(function() {
                                // Para a atualização da contagem regressiva
                                clearInterval(atualizarTempo);

                                // Reativa o botão
                                document.getElementById("meuBotao").disabled = false;

                                // Remove a contagem regressiva da página
                                document.getElementById("tempoRestante").innerHTML = "";
                            }, tempoTotal);
                        }
                    </script>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Editar Cadastro') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                        {{ __('SAIR') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
