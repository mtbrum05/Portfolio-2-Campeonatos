-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jan-2021 às 21:53
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `campeonatos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `campeonato`
--

CREATE TABLE `campeonato` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_tipo_campeonato` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `campeonato`
--

INSERT INTO `campeonato` (`id`, `nome`, `id_tipo_campeonato`, `data_criacao`, `data_inicio`, `data_fim`, `descricao`) VALUES
(1, 'Major Brasil 2020: Rio Edition', 1, '2020-10-30 19:00:00', '2020-11-30 19:00:00', '2020-12-30 19:00:00', 'Major ocorrrerá no Brasil entre os dias 30 de novembro e 30 de dezembro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` datetime NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id`, `descricao`, `data_criacao`, `nome`) VALUES
(1, 'Equipe profissional de cs:go', '2020-10-30 19:00:00', 'Furia'),
(2, 'Equipe profissional de cs:go', '2020-10-30 19:00:00', 'Mibr');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe_profissional`
--

CREATE TABLE `equipe_profissional` (
  `id` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `id_profissional` int(11) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `data_criacao` datetime NOT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='log de profissionais que passaram por cada equipe e se estão ativos ou não nas mesmas.';

--
-- Extraindo dados da tabela `equipe_profissional`
--

INSERT INTO `equipe_profissional` (`id`, `id_equipe`, `id_profissional`, `descricao`, `data_criacao`, `data_inicio`, `data_fim`, `ativo`) VALUES
(1, 1, 1, 'jogador kscerato agora é da furia', '2020-10-30 19:00:00', '2020-11-30 19:00:00', NULL, 1),
(2, 2, 2, 'jogador kng agora é da mibr', '2020-10-30 19:00:00', '2020-11-30 19:00:00', NULL, 1),
(3, 2, 3, 'jogador cogu participa agora da mibr', '2020-10-30 19:00:00', '2020-11-30 19:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_campeonato`
--

CREATE TABLE `log_campeonato` (
  `id` int(11) NOT NULL,
  `id_campeonato` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_inativacao` datetime DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `id_equipe_profissional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela que define quais equipes e jogadores que estão jogando determinado campeonato e se estão ativas ou não nos mesmos.';

--
-- Extraindo dados da tabela `log_campeonato`
--

INSERT INTO `log_campeonato` (`id`, `id_campeonato`, `data_criacao`, `ativo`, `data_inativacao`, `observacao`, `id_equipe_profissional`) VALUES
(1, 1, '2020-10-30 19:00:00', 1, NULL, NULL, 1),
(2, 1, '2020-10-30 19:00:00', 1, NULL, NULL, 2),
(3, 1, '2020-10-30 19:00:00', 0, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE `profissional` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `id_profissional` int(11) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`id`, `nome`, `data_criacao`, `id_profissional`, `descricao`) VALUES
(1, 'Kscerato', '2020-10-30 19:00:00', 1, 'Jogador profissional de cs:go'),
(2, 'kng', '2020-10-30 19:00:00', 1, 'Jogador profissional de cs:go'),
(3, 'cogu', '2020-10-30 19:00:00', 1, 'Jogador profissional de cs:go');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_campeonato`
--

CREATE TABLE `tipo_campeonato` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `data_criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_campeonato`
--

INSERT INTO `tipo_campeonato` (`id`, `descricao`, `data_criacao`) VALUES
(1, 'Major', '2020-10-30 19:00:00'),
(3, 'B-Tier', '2020-10-30 21:38:03'),
(5, 'B-Tier', '2020-11-03 15:11:03'),
(6, 'Minor', '2020-11-03 15:07:50'),
(8, 'a', '2020-11-03 15:47:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_profissional`
--

CREATE TABLE `tipo_profissional` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `data_criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_profissional`
--

INSERT INTO `tipo_profissional` (`id`, `descricao`, `data_criacao`) VALUES
(1, 'Jogador', '2020-10-30 19:00:00'),
(2, 'Coach', '2020-10-30 19:00:00'),
(3, 'Manager', '2020-11-03 15:37:45');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campeonato_fk` (`id_tipo_campeonato`);

--
-- Índices para tabela `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `equipe_profissional`
--
ALTER TABLE `equipe_profissional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipe_profissional_fk` (`id_equipe`),
  ADD KEY `equipe_profissional_fk_1` (`id_profissional`);

--
-- Índices para tabela `log_campeonato`
--
ALTER TABLE `log_campeonato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_campeonato_fk_2` (`id_campeonato`),
  ADD KEY `log_campeonato_fk` (`id_equipe_profissional`);

--
-- Índices para tabela `profissional`
--
ALTER TABLE `profissional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profissional_fk` (`id_profissional`);

--
-- Índices para tabela `tipo_campeonato`
--
ALTER TABLE `tipo_campeonato`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo_profissional`
--
ALTER TABLE `tipo_profissional`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `equipe_profissional`
--
ALTER TABLE `equipe_profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `log_campeonato`
--
ALTER TABLE `log_campeonato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `profissional`
--
ALTER TABLE `profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_campeonato`
--
ALTER TABLE `tipo_campeonato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tipo_profissional`
--
ALTER TABLE `tipo_profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `campeonato`
--
ALTER TABLE `campeonato`
  ADD CONSTRAINT `campeonato_fk` FOREIGN KEY (`id_tipo_campeonato`) REFERENCES `tipo_campeonato` (`id`);

--
-- Limitadores para a tabela `equipe_profissional`
--
ALTER TABLE `equipe_profissional`
  ADD CONSTRAINT `equipe_profissional_fk` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `equipe_profissional_fk_1` FOREIGN KEY (`id_profissional`) REFERENCES `profissional` (`id`);

--
-- Limitadores para a tabela `log_campeonato`
--
ALTER TABLE `log_campeonato`
  ADD CONSTRAINT `log_campeonato_fk` FOREIGN KEY (`id_equipe_profissional`) REFERENCES `equipe_profissional` (`id`),
  ADD CONSTRAINT `log_campeonato_fk_2` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id`);

--
-- Limitadores para a tabela `profissional`
--
ALTER TABLE `profissional`
  ADD CONSTRAINT `profissional_fk` FOREIGN KEY (`id_profissional`) REFERENCES `tipo_profissional` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
