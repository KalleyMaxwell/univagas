-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Abr-2023 às 17:43
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `univagas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `id_candidato` int(11) NOT NULL,
  `matricula` varchar(255) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `nome_candidato` varchar(255) NOT NULL,
  `email_candidato` varchar(255) NOT NULL,
  `senha_candidato` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `qualidades` text NOT NULL,
  `objetivos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`id_candidato`, `matricula`, `curso`, `nome_candidato`, `email_candidato`, `senha_candidato`, `telefone`, `genero`, `data_nascimento`, `cidade`, `estado`, `qualidades`, `objetivos`) VALUES
(30, '2023012660', '8', 'Kalley Maxwell ', 'kalley2015@hotmail.com', '$2y$12$UnaS9wr1ACtghLhdWak4uObSI0bBRQRJ7daj8VDRij3.uAsG8pqKa', '', '', '0000-00-00', 'Itajubá', 'MG', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat`
--

CREATE TABLE `chat` (
  `id_mensagem` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `remetente` varchar(255) DEFAULT NULL,
  `destinatario` varchar(255) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curriculo`
--

CREATE TABLE `curriculo` (
  `id_curriculo` int(11) NOT NULL,
  `id_candidato` int(11) DEFAULT NULL,
  `nome_candidato` varchar(255) NOT NULL,
  `email_candidato` varchar(255) NOT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `ano_conclusao` date DEFAULT NULL,
  `experiencia` text DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `tempo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(3) NOT NULL,
  `curso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `curso`) VALUES
(1, 'Administração'),
(2, 'Ciência da Computação'),
(3, 'Ciências Atmosféricas'),
(4, 'Ciências Biológicas Licenciatura'),
(5, 'Engenharia Ambiental'),
(6, 'Engenharia Civil'),
(7, 'Engenharia de Bioprocessos'),
(8, 'Engenharia de Computação'),
(9, 'Engenharia de Controle e Automação'),
(10, 'Engenharia de Energia'),
(11, 'Engenharia de Materiais'),
(12, 'Engenharia de Produção'),
(13, 'Engenharia Elétrica'),
(14, 'Engenharia Eletrônica'),
(15, 'Engenharia Hídrica'),
(16, 'Engenharia Mecânica'),
(17, 'Engenharia Mecânica Aeronáutica'),
(18, 'Engenharia Química'),
(19, 'Física Bacharelado'),
(20, 'Física Licenciatura'),
(21, 'Matemática Bacharelado'),
(22, 'Matemática Licenciatura'),
(23, 'Química Bacharelado'),
(24, 'Química Licenciatura'),
(25, 'Sistemas de Informação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nome_empresa` varchar(255) NOT NULL,
  `email_empresa` varchar(255) NOT NULL,
  `senha_empresa` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `descricao_empresa` text NOT NULL,
  `area_atuacao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nome_empresa`, `email_empresa`, `senha_empresa`, `cnpj`, `telefone`, `cidade`, `estado`, `descricao_empresa`, `area_atuacao`) VALUES
(15, 'univagas', 'univagas@gmail.com', '$2y$12$XQjBSy7WFgS5RBSvY0LBpOnDBJcMJK4zsKFHm7C8kTykJ3pBXSave', '', '', 'Itajubá', 'MG', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `id_imagem` int(11) NOT NULL,
  `id_conta` int(11) DEFAULT NULL,
  `nome_conta` varchar(255) DEFAULT NULL,
  `nome_imagem` varchar(255) DEFAULT NULL,
  `data_upload` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `id_vaga` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nome_empresa` varchar(255) DEFAULT NULL,
  `nome_vaga` varchar(255) DEFAULT NULL,
  `curso` varchar(255) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `descricao_vaga` text DEFAULT NULL,
  `requisitos` text DEFAULT NULL,
  `diferencial` text DEFAULT NULL,
  `total_vagas` int(11) DEFAULT NULL,
  `salario` decimal(11,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`id_candidato`);

--
-- Índices para tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_mensagem`);

--
-- Índices para tabela `curriculo`
--
ALTER TABLE `curriculo`
  ADD PRIMARY KEY (`id_curriculo`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id_imagem`);

--
-- Índices para tabela `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`id_vaga`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `candidato`
--
ALTER TABLE `candidato`
  MODIFY `id_candidato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curriculo`
--
ALTER TABLE `curriculo`
  MODIFY `id_curriculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id_vaga` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
