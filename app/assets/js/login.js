document.querySelector("#btn-entrar").addEventListener("click", async function(){
    // Desabilita o botão para o usuário não clicar novamente.
    this.innerText = 'Aguarde...';
    this.setAttribute('disabled', 'disabled');

    // Valida se os campos require do form estão preenchido.
    const resultadoValidacao = validarFormulario.call(document.querySelector("#painel-login"));

    if(resultadoValidacao){
        const email = document.querySelector("#email").value;
        const senha = document.querySelector("#senha").value;
        const dados = new FormData();

        dados.append('email', email);
        dados.append('senha', senha);

        try {
            const resultado = await axios({
                method: 'POST',
                url: '/gerenciador-cliente/login/autenticar',
                data: dados,
                responseType: 'json'
            });
    
            const {data} = resultado;
                
            if(data.status == 'sucesso'){
                window.location = "/gerenciador-cliente/home";
            }
            else{
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: data.mensagem,
                });
            }
        } catch (e){
            console.log('Error: ', e);
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Ocorreu algum erro. Tente novamente mais tarde',
            });
        }
    }
    else{
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Preencha todos os campos',
        });
    }

    // Habilita o botão novamente.
    this.innerText = 'Entrar';
    this.removeAttribute('disabled');
})

/**
 * Sempre que o usuário apertar ENTER no form de login já tentar autenticar.
 */
document.querySelector("#painel-login").addEventListener("keydown", function(e){
    const $this = e.target;
    if(e.keyCode === 13 && $this.nodeName === 'INPUT'){
        document.querySelector("#btn-entrar").click();
    }
})