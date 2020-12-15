-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Dez-2020 às 01:46
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `detalhes` text NOT NULL,
  `num_serial` varchar(50) NOT NULL,
  `num_patrimonio` varchar(50) NOT NULL,
  `departamento` varchar(200) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `equipamentos`
--

INSERT INTO `equipamentos` (`id`, `modelo`, `detalhes`, `num_serial`, `num_patrimonio`, `departamento`, `categoria`, `data_cadastro`) VALUES
(1, 'Dell Inpirion', '', '11225463', '1245865', 'Sala CGPA', 'Notbook', '2020-11-17'),
(2, 'aaaaaaaaaaa', '', '', '4444444444444', 'rrrrrrrrrrrrr', 'Selecione', '2020-11-17'),
(3, 'bbbbbb', '', '', 'ffffffffffff', '', 'Desktop', '2020-12-05'),
(4, 'ttttttt', '', 'tttttt', 'ttttttttttt', 'ttttttttt', 'Desktop', '2020-12-05'),
(5, 'Teste', 'jjjjjjjjjjjjjjjjjjj', '45682', 'ssssssssssssssssss', 'ssssssssssss', 'Desktop', '2020-12-11'),
(6, 'Computador', '3Gb Ram, HD 1tb', '123456', '1234567', 'Sala Integrada', 'Notbook', '2020-12-12');

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
(1, 'aaaaaaaaaa', 1, '2020-12-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Vanessa', 'v@v.com', '123');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
