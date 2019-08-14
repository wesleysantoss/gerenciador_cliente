document.querySelector("#btn-entrar").addEventListener("click", async function(){
    const resultadoValidacao = validarFormulario.call(document.querySelector("#painel-login"));

    if(resultadoValidacao){
        const email = document.querySelector("#email").value;
        const senha = document.querySelector("#senha").value;

        const formData = new FormData();

        formData.append('email', email);
        formData.append('senha', senha);

        try {
            const resultado = await axios({
                method: 'POST',
                url: '/gerenciador-cliente/login/autenticar',
                data: formData,
                responseType: 'json'
            });
    
            const {data} = resultado;
                
            if(data.status == 'sucesso'){
                window.location = "/gerenciador-cliente/home";
            }
            else{
                alert('Oops, e-mail ou senha incorretos');
            }
        } catch (e){
            alert('Oops, ocorreu algum erro. Tente novamente mais tarde');
        }
    }
    else{
        alert(`Preencha todos os campos`);
    }
})

document.querySelector("#painel-login").addEventListener("keydown", function(e){
    const $this = e.target;

    if(e.keyCode === 13 && $this.nodeName === 'INPUT'){
        document.querySelector("#btn-entrar").click();
    }
})