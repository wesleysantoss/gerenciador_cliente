document.querySelector("#btn-entrar").addEventListener("click", function(){
    const resultadoValidacao = validarFormulario.call(document.querySelector("#painel-login"));

    if(resultadoValidacao){
        const usuario = document.querySelector("#usuario").value;
        const senha = document.querySelector("#senha").value;

        
    }
    else{
        alert(`Preencha todos os campos`);
    }
})

