<?php

namespace App\models;
use App\config\ConnectionDB;

class Usuario 
{
    public $nome; 
    public $email;

    public function __construct($email)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("SELECT nome, email FROM usuarios WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->nome = $row['nome'];
            $this->email = $row['email'];
        }
        else{
            throw new \Exception("Nenhum usuário com o e-mail {$email}");
        }
    }

    /**
     * Valida se o usuário existe.
     * @param $email - E-mail do usuário.
     * @param $senha - Senha do usuário.
     * @return Bool.
     */
    public static function autenticar($email, $senha)
    {
        $pdo = ConnectionDB::getConnection();

        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM usuarios WHERE email = :email AND senha = MD5(:senha)");
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return ($row['total']);
    }

}

?>