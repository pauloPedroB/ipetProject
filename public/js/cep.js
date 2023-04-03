




const addressForm = document.querySelector('#addres')
const cepInput = document.querySelector("#cep")
const addressInput = document.querySelector("#street")
const neighborhoodInput = document.querySelector("#neighborhood")
const cityInput = document.querySelector("#city")
const ufInput = document.querySelector("#uf")
const latInput = document.querySelector("#lat")
const longInput = document.querySelector("#long")
const numberInput = document.querySelector("#Number")





cepInput.addEventListener("keypress",(e)=>{
    const onlyNumbers = /[0-9]/;
    const key = String.fromCharCode(e.keyCode);
    if(!onlyNumbers.test(key))
    {
        e.preventDefault();
        return;
    }

    cepInput.addEventListener("keyup", (e)=>{

        const inputValue = e.target.value

        if(inputValue.length === 8){
            getAddress(inputValue);
        }

    });

    const getAddress = async (cep)=>{
        cepInput.blur();
        console.log(cep)
        const apiURL = `https://viacep.com.br/ws/${cep}/json/`
        const response = await fetch(apiURL)
        const data = await response.json()
        if(data.erro === true){
            addressForm.reset();
            toggleMessage('CEP INVÁLIDO!!');
        }
        else{
            addressInput.value = data.logradouro
            neighborhoodInput.value = data.bairro
            cityInput.value = data.localidade
            ufInput.value = data.uf

            if(numberInput.value !==null)
            {
                const api_key = 'AIzaSyCXoIfvEDdZDSGfKCDEfcdxBoaTY1ooX-4';
        
                fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${addressInput.value} ${numberInput.value},${cep}&key=${api_key}`)
                .then(response => response.json())
                .then(data => {
                    const location = data.results[0].geometry.location;
                    const latitude = location.lat;
                    const longitude = location.lng;
                    latInput.value = latitude;
                    longInput.value = longitude
                })
                .catch(error => console.error(error));
                }
            }
           
        
    }

    const toggleMessage =(msg)=>{
        const messageElement = document.querySelector("#message p");
        messageElement.style.backgroundColor = 'red';
        messageElement.innerText = msg;
    }

  
})