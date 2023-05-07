<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger"><p style="color: brown">{{ session('error') }}</p></div>
        @endif
        <form method="POST" action="/entrando" id="myForm">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4" id="password-input">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <button type="button" onclick="togglePasswordVisibility()" class="toggle-password"></button>
            </div>
            <style>
                #password-input {
                    position: relative;
                }

                #password-input .toggle-password {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    transform: translateY(-50%);
                    background-color: transparent;
                    border: none;
                    outline: none;
                    cursor: pointer;
                    width: 25px;
                    height: 25px;
                    background-image: url('https://cdn-icons-png.flaticon.com/512/3178/3178377.png');
                    background-repeat: no-repeat;
                    background-size: contain;
                }

                #password-input .toggle-password.hide {
                    background-image: url('https://cdn-icons-png.flaticon.com/512/3502/3502545.png');
                }
            </style>
            <script>
                function togglePasswordVisibility() {
                  var senhaInput = document.getElementById("password");
                  var toggleBtn = document.querySelector(".toggle-password");
                  if (senhaInput.type === "password") {
                    senhaInput.type = "text";
                    toggleBtn.classList.add("hide");
                  } else {
                    senhaInput.type = "password";
                    toggleBtn.classList.remove("hide");
                  }
                }
            </script>
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembre-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-around mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="/register">
                    {{ __('Cadastre-se?') }}
                </a>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Entrar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>


