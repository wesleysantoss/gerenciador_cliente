<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ControllerClienteTest extends TestCase {
    private $http;

    /**
     * Mock para o teste.
     */
    private $nomeClienteTeste = "Wesley Santos";
    private $cpfClienteTeste = "45934082884";
    private $rgClienteTeste = "49979333x";
    private $telefoneClienteTeste = "1996392964";
    private $dataNascimentoClienteTeste = "1996-03-01";
    private $cepClienteTeste = "13504657";
    private $ruaClienteTeste = "Rua 24PA";
    private $numeroClienteTeste = "436";
    private $bairroClienteTeste = "Jd Panorama";
    private $cidadeClienteTeste = "Rio Claro";
    private $ufClienteTeste = "SP";
    private $complementoClienteTeste = "";
    private $principalClienteTeste = "Sim";

    protected function setUp()
    {
        // Função chamada antes de cada teste.
        $this->http = new Client([
            'base_uri' => 'http://127.0.0.1/gerenciador-cliente/
        ']);
    }

    public function testCadastrarNovoCliente()
    {
        $response = $this->http->request('POST', 'cliente/cadastrar', [
            'form_params' => [
                'nome' => $this->nomeClienteTeste,
                'cpf' => $this->cpfClienteTeste,
                'rg' => $this->rgClienteTeste,
                'telefone' => $this->telefoneClienteTeste,
                'dataNascimento' => $this->dataNascimentoClienteTeste,
                'cep[]' => $this->cepClienteTeste,
                'rua[]' => $this->ruaClienteTeste,
                'numero[]' => $this->numeroClienteTeste,
                'bairro[]' => $this->bairroClienteTeste,
                'cidade[]' => $this->cidadeClienteTeste,
                'uf[]' => $this->ufClienteTeste,
                'complemento[]' => $this->complementoClienteTeste,
                'principal[]' => $this->principalClienteTeste
            ]
        ]);

        $body = json_decode($response->getBody());
        $status = (string) $body->status;
        $statusEsperado = "sucesso";

        self::assertEquals($status, $statusEsperado);
    }

    public function testAtualizarCliente()
    {
        $responseListarPorCPF = $this->http->request('POST', 'cliente/listarPorCPF', [
            'form_params' => [
                'cpf' => $this->cpfClienteTeste
            ]
        ]);

        $bodyListarPorCPF = json_decode($responseListarPorCPF->getBody());
        $idCliente = (int) $bodyListarPorCPF->id;
        $this->idClienteTeste = $idCliente;

        $responseAtualizar = $this->http->request('POST', 'cliente/atualizar', [
            'form_params' => [
                'id' => $idCliente,
                'nome' => 'Wesley Atualizado',
                'cpf' => $this->cpfClienteTeste,
                'rg' => $this->rgClienteTeste,
                'telefone' => $this->telefoneClienteTeste,
                'dataNascimento' => $this->dataNascimentoClienteTeste,
            ]
        ]);  

        $bodyAtualizar = json_decode($responseAtualizar->getBody());
        $status = $bodyAtualizar->status;
        $statusEspero = "sucesso";

        self::assertEquals($status, $statusEspero);
    }

    public function testExcluirCliente()
    {
        $responseListarPorCPF = $this->http->request('POST', 'cliente/listarPorCPF', [
            'form_params' => [
                'cpf' => $this->cpfClienteTeste
            ]
        ]);

        $bodyListarPorCPF = json_decode($responseListarPorCPF->getBody());
        $idCliente = (int) $bodyListarPorCPF->id;
        $this->idClienteTeste = $idCliente;

        $responseExcluir = $this->http->request('POST', 'cliente/excluir', [
            'form_params' => [
                'id' => $idCliente
            ]
        ]);  

        $bodyExcluir = json_decode($responseExcluir->getBody());
        $status = $bodyExcluir->status;
        $statusEspero = "sucesso";

        self::assertEquals($status, $statusEspero);
    }
}