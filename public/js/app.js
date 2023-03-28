const pre_carregamento = document.querySelector("div.pre-carregamento");

function preCarregamento(){
    pre_carregamento.style.opacity="0";

    setTimeout(()=>{
        pre_carregamento.style.display="none";
    },500)
}
var cpf = document.querySelector("#cpf");

cpf.addEventListener("blur", function(){
   if(cpf.value) cpf.value = cpf.value.match(/.{1,3}/g).join(".").replace(/\.(?=[^.]*$)/,"-");
});