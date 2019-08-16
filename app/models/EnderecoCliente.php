<?php 

namespace App\models;
use App\config\ConnectionDB;

class EnderecoCliente {
    private $id;
    private $idCliente;
    private $dataCadastro;

    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $complemento;
    public $enderecoPrincipal;

    public function __construct($id)
    {   
        $pdo = ConnectionDB::getConnection();
        
        $stmt = $pdo->prepare("SELECT id_cliente, rua, numero, bairro, cidade, estado, complemento, endereco_principal, data_cadastro FROM endereco_cliente WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->idCliente = $row['id_cliente'];
            $this->rua = $row['rua'];
            $this->numero = $row['numero'];
            $this->bairro = $row['bairro'];
            $this->cidade = $row['cidade'];
            $this->estado = $row['estado'];
            $this->complemento = $row['complemento'];
            $this->endereco_principal = $row['endereco_principal'];
            $this->dataCadastro = $row['data_cadastro'];
        }
        else{
            throw new Exception("Nenhum endereço com o id {$id}");
        }
    }

    public static function criar($idCliente, $rua, $numero, $bairro, $cidade, $estado, $complemento, $enderecoPrincipal)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("INSERT INTO endereco_cliente (id_cliente, rua, numero, bairro, cidade, estado, complemento, endereco_principal) VALUES (:id_cliente, :rua, :numero, :bairro, :cidade, :estado, :complemento, :endereco_principal)");
        $stmt->bindValue(':id_cliente', $idCliente);
        $stmt->bindValue(':rua', $rua);
        $stmt->bindValue(':numero', $numero);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':complemento', $complemento);
        $stmt->bindValue(':endereco_principal', $enderecoPrincipal);
        return $stmt->execute();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function getDataCadastro()
    {
        return $this->dataCadastro;
    } 

    public static function buscarPorCliente($idCliente)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("SELECT id, rua, numero, bairro, cidade, estado, complemento, endereco_principal, data_cadastro FROM endereco_cliente WHERE id_cliente = :id_cliente");
        $stmt->bindValue(':id_cliente', $idCliente);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function buscarPorPrincipalCliente($idCliente)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("SELECT id, rua, numero, bairro, cidade, estado, complemento, endereco_principal, data_cadastro FROM endereco_cliente WHERE id_cliente = :id_cliente AND endereco_principal = 'S'");
        $stmt->bindValue(':id_cliente', $idCliente);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function editar($id, $rua, $numero, $bairro, $cidade, $estado, $complemento, $enderecoPrincipal)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("UPDATE endereco_cliente SET rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, complemento = :complemento, endereco_principal = :endereco_principal WHERE id = :id");
        $stmt->bindValue(':rua', $rua);
        $stmt->bindValue(':numero', $numero);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':complemento', $complemento);
        $stmt->bindValue(':endereco_principal', $enderecoPrincipal);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public static function excluir($id)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("DELETE FROM endereco_cliente WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}