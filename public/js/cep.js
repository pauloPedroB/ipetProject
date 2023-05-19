
const addressForm = document.querySelector('#addres')
const cepInput = document.querySelector("#cep")
const addressInput = document.querySelector("#street")
const neighborhoodInput = document.querySelector("#neighborhood")
const cityInput = document.querySelector("#city")
const ufInput = document.querySelector("#uf")
const latInput = document.querySelector("#lat")
const longInput = document.querySelector("#long")
const numberInput = document.querySelector("#Number")





cepInput.addEventListener("blur", async function() {
    const onlyNumbers = /[0-9]/;
    
    cepInput.blur();
    
    const cep = cepInput.value.replace(/\D/g, '');
    
    const apiURL = `https://viacep.com.br/ws/${cep}/json/`;
    
    try {
      const response = await fetch(apiURL);
      const data = await response.json();
      if (data.erro === true) {
        cepInput.value = "";
        toggleMessage('CEP INVÁLIDO!!');
      } else {
        addressInput.value = data.logradouro;
        neighborhoodInput.value = data.bairro;
        cityInput.value = data.localidade;
        ufInput.value = data.uf;
      }
    } catch (error) {
      console.error(error);
    }
  });

