<?php

namespace App\models;
use App\config\ConnectionDB;

class User 
{
	public $id;
	public $name;
	public $username;
	public $password;

	public function __construct($id)
	{
		$pdo = connectionDB::getConnection();

		$stmt = $pdo->prepare("SELECT id, name, username, password FROM user WHERE id = :id");
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->id = $row['id'];
			$this->name = $row['name'];
			$this->username = $row['username'];
			$this->password = $row['password'];
		}
	}

	static function create($name, $username, $password)
	{
		$pdo = connectionDB::getConnection();

		$stmt = $pdo->prepare("INSERT INTO user (name, username, password) VALUES (:name, :username, :password)");
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':password', $password);
		return $stmt->execute();
	}
  
	static function findByUserName($username)
	{
		$pdo = connectionDB::getConnection();

		$stmt = $pdo->prepare("SELECT id, name, username, password FROM user WHERE username = :username");
		$stmt->bindValue(':username', $username);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	static function authenticate($username, $password)
	{
		$pdo = connectionDB::getConnection();

		$stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM user WHERE username = :username AND password = :password");
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return ($row['total']);
	}
}

?>