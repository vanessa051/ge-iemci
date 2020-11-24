-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Nov-2020 às 14:58
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ge-iemci`
--
CREATE DATABASE IF NOT EXISTS `ge-iemci` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ge-iemci`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `detalhes` text NOT NULL,
  `num_serial` float NOT NULL,
  `num_patrimonio` float NOT NULL,
  `departamento` varchar(200) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `equipamentos`
--

INSERT INTO `equipamentos` (`id`, `modelo`, `detalhes`, `num_serial`, `num_patrimonio`, `departamento`, `categoria`, `data_cadastro`) VALUES
(1, 'Dell Inspirion', 'Alguma coisa importante', 0, 0, 'Sala CGPA', 'Nootbook', '2020-11-04'),
(2, 'Hp Compaq', 'Alguma coisa importante', 123547000, 155455000, 'Sala Multimidia', 'desktop', '2020-11-10'),
(3, 'Impressora', 'Impressoa a Jato', 22562700, 193650, 'Integrada', 'equipamento', '2020-11-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `id_equip` int(11) NOT NULL,
  `data_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `registro`
--

INSERT INTO `registro` (`id`, `descricao`, `id_equip`, `data_registro`) VALUES
(1, 'aaaaaaaaaaa', 2, '2020-11-10'),
(2, 'Saiu para manutenção', 3, '2020-11-10'),
(3, 'Chegou da manutenção', 3, '2020-11-10');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
