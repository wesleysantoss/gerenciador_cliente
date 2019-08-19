-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.3.16-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para gerenciador-clientes
CREATE DATABASE IF NOT EXISTS `gerenciador-clientes` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `gerenciador-clientes`;

-- Copiando estrutura para tabela gerenciador-clientes.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) COLLATE utf8_bin NOT NULL,
  `rg` varchar(10) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(11) COLLATE utf8_bin NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `rg` (`rg`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela gerenciador-clientes.clientes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nome`, `cpf`, `rg`, `telefone`, `data_nascimento`, `data_cadastro`) VALUES
	(118, 'Wesley Santos', '96265752049', '4599987887', '1996392964', '1996-03-01', '2019-08-18 23:08:01'),
	(119, 'João Silva', '33119118060', '9987898985', '1935358899', '1995-01-05', '2019-08-18 23:10:23');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela gerenciador-clientes.endereco_cliente
CREATE TABLE IF NOT EXISTS `endereco_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `cep` varchar(10) COLLATE utf8_bin NOT NULL,
  `rua` varchar(100) COLLATE utf8_bin NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(100) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(50) COLLATE utf8_bin NOT NULL,
  `estado` char(2) COLLATE utf8_bin NOT NULL,
  `complemento` varchar(200) COLLATE utf8_bin NOT NULL,
  `endereco_principal` set('Sim','Não') COLLATE utf8_bin NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK__clientes` (`id_cliente`),
  CONSTRAINT `FK__clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela gerenciador-clientes.endereco_cliente: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `endereco_cliente` DISABLE KEYS */;
INSERT INTO `endereco_cliente` (`id`, `id_cliente`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `complemento`, `endereco_principal`, `data_cadastro`) VALUES
	(114, 118, '13504657', 'Rua 24 PA', 436, 'Jardim Panorama', 'Rio Claro', 'SP', '', 'Sim', '2019-08-18 23:08:01'),
	(115, 118, '13504652', 'Avenida 64 B', 55, 'Jardim Panorama', 'Rio Claro', 'SP', '', 'Não', '2019-08-18 23:08:01'),
	(116, 119, '13504652', 'Avenida 64 B', 33, 'Jardim Panorama', 'Rio Claro', 'SP', '', 'Sim', '2019-08-18 23:10:23');
/*!40000 ALTER TABLE `endereco_cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela gerenciador-clientes.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nome` varchar(150) COLLATE utf8_bin NOT NULL,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `senha` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela gerenciador-clientes.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`nome`, `email`, `senha`) VALUES
	('Felipe', 'fescudeiro@kabum.com.br', '698dc19d489c4e4db73e28a713eab07b'),
	('Murilo', 'murilo.bezerril@kabum.com.br', '698dc19d489c4e4db73e28a713eab07b'),
	('Wesley', 'wessleysanttos@live.com', '698dc19d489c4e4db73e28a713eab07b');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
