-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Dez-2022 às 23:20
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbtotem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhas_de_onibus`
--

CREATE TABLE `linhas_de_onibus` (
  `idlinhas` int(11) NOT NULL,
  `codigo` varchar(5) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `caracteristica` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `linhas_de_onibus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `terminal`
--

CREATE TABLE `terminal` (
  `idterminal` int(11) NOT NULL,
  `terminal_origem` varchar(50) DEFAULT NULL,
  `terminal_destino` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `terminal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `terminal_linhas`
--

CREATE TABLE `terminal_linhas` (
  `idterminal_linhas` int(11) NOT NULL,
  `plataforma` varchar(5) DEFAULT NULL,
  `idterminal` int(11) DEFAULT NULL,
  `idlinhas` int(11) DEFAULT NULL,
  `idtipo_sentido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `terminal_linhas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_sentido`
--

CREATE TABLE `tipo_sentido` (
  `idtipo_sentido` int(11) NOT NULL,
  `descricao` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_sentido`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `linhas_de_onibus`
--
ALTER TABLE `linhas_de_onibus`
  ADD PRIMARY KEY (`idlinhas`);

--
-- Índices para tabela `terminal`
--
ALTER TABLE `terminal`
  ADD PRIMARY KEY (`idterminal`);

--
-- Índices para tabela `terminal_linhas`
--
ALTER TABLE `terminal_linhas`
  ADD PRIMARY KEY (`idterminal_linhas`),
  ADD KEY `fk_idterminal` (`idterminal`),
  ADD KEY `fk_idlinhas` (`idlinhas`),
  ADD KEY `fk_idtipo_sentido` (`idtipo_sentido`);

--
-- Índices para tabela `tipo_sentido`
--
ALTER TABLE `tipo_sentido`
  ADD PRIMARY KEY (`idtipo_sentido`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `linhas_de_onibus`
--
ALTER TABLE `linhas_de_onibus`
  MODIFY `idlinhas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `terminal`
--
ALTER TABLE `terminal`
  MODIFY `idterminal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `terminal_linhas`
--
ALTER TABLE `terminal_linhas`
  MODIFY `idterminal_linhas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `tipo_sentido`
--
ALTER TABLE `tipo_sentido`
  MODIFY `idtipo_sentido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `terminal_linhas`
--
ALTER TABLE `terminal_linhas`
  ADD CONSTRAINT `fk_idlinhas` FOREIGN KEY (`idlinhas`) REFERENCES `linhas_de_onibus` (`idlinhas`),
  ADD CONSTRAINT `fk_idterminal` FOREIGN KEY (`idterminal`) REFERENCES `terminal` (`idterminal`),
  ADD CONSTRAINT `fk_idtipo_sentido` FOREIGN KEY (`idtipo_sentido`) REFERENCES `tipo_sentido` (`idtipo_sentido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
