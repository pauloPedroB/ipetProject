<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}" id="myForm">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <button type="button" onclick="togglePasswordVisibility()" class="toggle-password"></button>

            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirme Senha') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <button type="button" onclick="togglePasswordVisibility2()" class="toggle-password2"></button>

            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Senha') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
<script>
    const form = document.getElementById("myForm");
    const msg = document.getElementById('error-message');
    form.addEventListener("submit", function(event)
    {
        console.log('teste');
        event.preventDefault();
        const re = /\S+@\S+\.\S+/;
        if(re.test(document.getElementById('email').value)==false){
            msg.innerText = 'Email inválido';
            msg.style.color = 'red';
            document.getElementById('lbemail').style.color = 'red';
            return;
        }
        const rs = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        if(rs.test(document.getElementById('password').value) == false){
            msg.innerText = 'Sua senha deve conter no mínimo 8 caracteres, sendo com pelo menos um caractere especial, um número e uma letra maiuscula';
            msg.style.color = 'red';
            document.getElementById('lbpass').style.color = 'red';
            return;
        }
        if(document.getElementById('password').value != document.getElementById('password_confirmation').value){
            msg.innerText = 'Senha e confirmação de senha devem ser iguais';
            msg.style.color = 'red';
            document.getElementById('lbpass').style.color = 'red';
            document.getElementById('lbpassc').style.color = 'red';
            return;
        }
        return form.submit();

    });
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

    function togglePasswordVisibility2() {
      var senhaInput = document.getElementById("password_confirmation");
      var toggleBtn = document.querySelector(".toggle-password2");
      if (senhaInput.type === "password") {
        senhaInput.type = "text";
        toggleBtn.classList.add("hide");
      } else {
        senhaInput.type = "password";
        toggleBtn.classList.remove("hide");
      }
    }
</script>
<style>
    #password-input {
        position: relative;
    }
    #password-input .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
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
    #password-input .toggle-password2{
        position: absolute;
        top: 50%;
        right: 10px;
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
    #password-input .toggle-password2.hide{
        background-image: url('https://cdn-icons-png.flaticon.com/512/3502/3502545.png');
    }
</style>
