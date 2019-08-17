<?php 

namespace App\models;
use App\config\ConnectionDB;
use App\models\EnderecoCliente;

class Cliente {
    private $id;
    private $dataCadastro;

    public $nome;
    public $cpf;
    public $rg;
    public $telefone;
    public $dataNascimento;

    public function __construct($id)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("SELECT nome, cpf, rg, telefone, data_nascimento, data_cadastro FROM clientes WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->nome = $row['nome'];
            $this->cpf = $row['cpf'];
            $this->rg = $row['rg'];
            $this->telefone = $row['telefone'];
            $this->dataNascimento = $row['data_nascimento'];
            $this->dataCadastro = $row['data_cadastro'];
        }
        else{
            throw new Exception("Nenhum cliente com o id {$id}");
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Cadastra um novo cliente
     * @param $nome - Nome
     * @param $cpf - CPF
     * @param $rg - RG
     * @param $telefone - Telefone
     * @param $dataNascimento - Data de nascimento
     * @return Bool
     */
    public static function criar($nome, $cpf, $rg, $telefone, $dataNascimento)
    { 
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, rg, telefone, data_nascimento) VALUES (:nome, :cpf, :rg, :telefone, :data_nascimento)");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':rg', $rg);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':data_nascimento', $dataNascimento);
        $stmt->execute();

        return $pdo->lastInsertId();
    }

    /**
     * Busca todos os clientes que existe
     */
    public static function buscarTodos()
    {
        $pdo = ConnectionDB::getConnection();
        
        $stmt = $pdo->prepare("SELECT id, nome, cpf, rg, telefone, data_nascimento, data_cadastro FROM clientes");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Exclui um cliente especifico
     * @param $id - ID do cliente a ser excluido
     * @return Bool
     */
    public static function excluir($id)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    /**
     * Atualiza as informações do objeto instanciado.
     */
    public function atualizar()
    { 
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("UPDATE clientes SET nome = :nome, cpf = :cpf, rg = :rg, telefone = :telefone, data_nascimento = :data_nascimento WHERE id = :id");
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':cpf', $this->cpf);
        $stmt->bindValue(':rg', $this->rg);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':data_nascimento', $this->dataNascimento);
        $stmt->bindValue(':id', $this->id);
        return $stmt->execute();
    }

    /**
     * Busca todos os endereços do objeto instanciado.
     */
    public function buscarTodosEnderecos()
    {
        return EnderecoCliente::buscarPorCliente($this->id);
    }
}

?>