-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Out-2022 às 20:39
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aparelhos_aerobico`
--

DROP TABLE IF EXISTS `tb_aparelhos_aerobico`;
CREATE TABLE IF NOT EXISTS `tb_aparelhos_aerobico` (
  `codigo` int(3) NOT NULL,
  `nome_aparelho` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `preco` decimal(7,0) NOT NULL,
  `funcao` varchar(80) NOT NULL,
  `velocidade_max` decimal(3,0) NOT NULL,
  `velocidade_min` decimal(3,0) NOT NULL,
  `material` varchar(50) NOT NULL,
  `peso` decimal(4,0) NOT NULL,
  `comentarios` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_aparelhos_aerobico`
--

INSERT INTO `tb_aparelhos_aerobico` (`codigo`, `nome_aparelho`, `marca`, `preco`, `funcao`, `velocidade_max`, `velocidade_min`, `material`, `peso`, `comentarios`) VALUES
(1, 'Esteira', 'Lyon Fitness', '3', 'Correr e caminhar.', '25', '4', 'Aço Carbono, Aço Inox, Alumínio, Polímero', '150', '---'),
(2, 'Bicicleta Ergométrica', 'Lyon Fitness', '2', 'Pedalar', '24', '4', 'Aço Carbono, Aço Inox.', '100', '---');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_aparelhos_musculacao`
--

DROP TABLE IF EXISTS `tb_aparelhos_musculacao`;
CREATE TABLE IF NOT EXISTS `tb_aparelhos_musculacao` (
  `codigo` int(3) NOT NULL,
  `nome_aparelho` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `preco` decimal(7,0) NOT NULL,
  `funcao` varchar(80) NOT NULL,
  `carga_max` int(3) NOT NULL,
  `carga_min` int(1) NOT NULL,
  `material` varchar(50) NOT NULL,
  `peso` decimal(4,0) NOT NULL,
  `comentarios` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_aparelhos_musculacao`
--

INSERT INTO `tb_aparelhos_musculacao` (`codigo`, `nome_aparelho`, `marca`, `preco`, `funcao`, `carga_max`, `carga_min`, `material`, `peso`, `comentarios`) VALUES
(3, 'Banco Supino Reto', 'Lyon Fitness', '500', 'Realizar Supino', 300, 4, 'Aço Carbono', '60', '---'),
(4, 'Barra Fixa', 'Lyon Fitness', '300', 'Realizar barra, exercício para dorsal.', 150, 0, 'Aço Inox', '20', '---'),
(5, 'Leg 45', 'Cop Fitness', '1', 'Realizar treino de perna', 1, 0, 'Ferro', '100', 'O Leg Press 45° da linha Bolt, possui encosto para estabilizar o usuário de maneira confortável, plataforma ampla e alavanca lateral de fácil acesso – facilitando o início e pausa do exercício.'),
(6, 'Voador', 'Movement', '460', 'Realizar exercícios para peitoral.', 150, 5, 'Polímero e Ferro', '200', 'Voador (também conhecido como peck deck) é um exercício de treinamento de força. Também é chamado de \"Peck Deck\", ou Hulk. ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

DROP TABLE IF EXISTS `tb_cliente`;
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `tempo_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `localidade` varchar(30) NOT NULL,
  `uf` varchar(2) NOT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`cpf`, `nome`, `telefone`, `tempo_login`, `email`, `senha`, `cep`, `logradouro`, `bairro`, `localidade`, `uf`) VALUES
('11122233312', 'eduardo', '3213', '2022-10-06 16:48:57', 'edu@gmail.com', '25d55ad283aa400af464c76d713c07ad', '0', '', '', '', ''),
('12345645674', 'joao', '32323232323', '2022-10-06 17:01:22', 'jpmacedo@email', 'e717c165a413da6989b51cf19a070872', '36036-100', 'Rua Engenheiro José Carlos de Morais Sarmento', 'Santa Catarina', 'Juiz de Fora', 'MG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ficha`
--

DROP TABLE IF EXISTS `tb_ficha`;
CREATE TABLE IF NOT EXISTS `tb_ficha` (
  `codigo` varchar(3) NOT NULL,
  `aparelhos` varchar(100) NOT NULL,
  `exercicios` varchar(100) NOT NULL,
  `series` varchar(2) NOT NULL,
  `repeticoes` varchar(2) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
