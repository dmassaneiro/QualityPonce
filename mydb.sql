-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Dez-2017 às 13:02
-- Versão do servidor: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexotreinamento`
--

CREATE TABLE `anexotreinamento` (
  `caminho` text,
  `treinamentoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE `arquivo` (
  `caminho` text,
  `documentoId` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `id` int(11) NOT NULL,
  `versao` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `arquivo`
--

INSERT INTO `arquivo` (`caminho`, `documentoId`, `data`, `id`, `versao`) VALUES
('../Documentos/7ac50e5db7a747a0501a4639aadc50f723365161_503159723372874_159905850_n.jpg', 67, '2017-11-17 00:00:00', 26, 1),
('../Documentos/3ed7fcf482e58dafb3fafaaa0eb0bc3323140472_499789323709914_999121651_n.png', 67, '2017-11-17 14:11:39', 27, 2),
('../Documentos/0670a83f31fea79abc5897d7839c125bResumo da aula 30-10.docx', 68, '2017-11-21 00:00:00', 28, 1),
('../Documentos/0bbed4a8bf2a1f5bf6fa1befcd12cfbeusuario-icone.png', 69, '2017-11-29 08:48:20', 29, 1),
('../Documentos/29f7d14861a0f219e2838cac3e489cfcAsset 2.png', 70, '2017-11-29 14:31:32', 31, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `objetivos` text,
  `escopo` text,
  `sugestao` text,
  `conclusao` text,
  `setorId` int(11) NOT NULL,
  `auditor` varchar(200) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `auditoria`
--

INSERT INTO `auditoria` (`id`, `dataInicio`, `dataFim`, `objetivos`, `escopo`, `sugestao`, `conclusao`, `setorId`, `auditor`, `situacao`) VALUES
(38, '2017-11-17', '2017-11-17', 'IDENTIFICAR ERROS', 'TODO SETOR DA QUALIDADE', '', '', 3, 'DIEGO MASSANEIRO', 'F'),
(39, '2017-11-27', '2017-11-27', 'ASDASD', 'ASDA', '', '', 3, 'DIEGO MASSANEIRO', 'C'),
(40, '2017-11-26', '2017-11-26', 'ASDASD', 'ASDSAD', '', '', 2, 'ADASDADS', 'C'),
(42, '2017-11-28', '2017-11-28', '', '', '', '', 3, 'DIEGO MASSANEIRO', 'F'),
(43, '2017-11-28', '2017-11-29', '', '', '', '', 3, 'DIEGO MASSANEIRO', 'C'),
(44, '2017-11-28', '2017-11-28', 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', '', '', 3, 'ADA123', 'C'),
(45, '2017-11-29', '2017-11-29', 'AGILISAR O PROCESSO DE PRODUCAO ', '', 'DEMITIR TODOS OS FUNCIONARIOS, POIS TODOS ESTAO ATRASADOS', 'NOVOS FUNCIONARIOS', 3, 'JUDITH GOMES', 'F');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoriaquestionario`
--

CREATE TABLE `auditoriaquestionario` (
  `auditoriaId` int(11) NOT NULL,
  `itemQuestionarioId` int(11) NOT NULL,
  `resposta` char(3) NOT NULL,
  `evidencia` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `auditoriaquestionario`
--

INSERT INTO `auditoriaquestionario` (`auditoriaId`, `itemQuestionarioId`, `resposta`, `evidencia`) VALUES
(38, 5, 'NC', ''),
(39, 5, 'NC', ''),
(40, 5, 'NC', ''),
(42, 5, 'NC', ''),
(43, 5, 'NC', ''),
(44, 5, 'NC', ''),
(44, 6, 'C', ''),
(45, 6, 'NC', ''),
(45, 7, 'NC', 'RELOGIO PONTO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacaocriterio`
--

CREATE TABLE `avaliacaocriterio` (
  `avaliacaoFornecedorId` int(11) NOT NULL,
  `criterioFornecedorId` int(11) NOT NULL,
  `pontuacao` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacaocriterio`
--

INSERT INTO `avaliacaocriterio` (`avaliacaoFornecedorId`, `criterioFornecedorId`, `pontuacao`) VALUES
(8, 1, '8.00'),
(8, 2, '10.00'),
(8, 3, '9.00'),
(9, 1, '7.00'),
(9, 2, '7.00'),
(9, 3, '10.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacaofornecedor`
--

CREATE TABLE `avaliacaofornecedor` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `media` decimal(10,2) NOT NULL,
  `produtosServicos` text NOT NULL,
  `observacao` text CHARACTER SET utf8,
  `Fornecedor_id` int(11) NOT NULL,
  `statusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacaofornecedor`
--

INSERT INTO `avaliacaofornecedor` (`id`, `data`, `media`, `produtosServicos`, `observacao`, `Fornecedor_id`, `statusId`) VALUES
(8, '2017-11-21', '27.00', 'PEÇAS LKKJDKLAJDLAJDLAI', 'OBRA ESCRITA CONSIDERADA NA SUA REDAçãO ORIGINAL E AUTêNTICA (POR OPOSIçãO A SUMáRIO, TRADUçãO, NOTAS, COMENTáRIOS, ETC.)', 1, 2),
(9, '2017-11-29', '24.00', 'BATATA', '', 18, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`) VALUES
(1, 'CATEGORIA 1'),
(5, 'DIEGO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `estadoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`id`, `nome`, `estadoId`) VALUES
(1, 'CAMPO MOURÃO', 1),
(2, 'SÃO PAULO', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `criterioaprovacao`
--

CREATE TABLE `criterioaprovacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `criterioaprovacao`
--

INSERT INTO `criterioaprovacao` (`id`, `descricao`) VALUES
(1, 'ATENDIMENTO '),
(2, 'QUALIDADE DO SERVIÇO/PRODUTO'),
(3, 'COMPROMETIMENTO COM PRAZOS ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `criteriofornecedor`
--

CREATE TABLE `criteriofornecedor` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `notaPeso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `criteriofornecedor`
--

INSERT INTO `criteriofornecedor` (`id`, `descricao`, `notaPeso`) VALUES
(1, 'ATENDIMENTO', 10),
(2, 'QUALIDADE DO SERVIÇO/PRODUTO\r\n\r\n', 10),
(3, 'COMPROMETIMENTO COM PRAZOS ', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `Id` int(11) NOT NULL,
  `dataRevisao` date NOT NULL,
  `descricao` text NOT NULL,
  `autor` text NOT NULL,
  `dataAprovacao` date DEFAULT NULL,
  `dataValidade` date NOT NULL,
  `statusId` int(11) NOT NULL,
  `tipoDocumentoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documento`
--

INSERT INTO `documento` (`Id`, `dataRevisao`, `descricao`, `autor`, `dataAprovacao`, `dataValidade`, `statusId`, `tipoDocumentoId`) VALUES
(67, '2017-11-17', '', 'SDASDSADA', NULL, '2018-11-17', 5, 5),
(68, '2017-11-21', 'FORMULÁRIO NOVO', 'DIEGO MASSANEIRO', NULL, '2018-11-21', 2, 5),
(69, '2017-11-27', 'SD', 'DIEGO MASSANEIRO', NULL, '2018-11-27', 2, 3),
(70, '2017-11-29', 'DOC', 'JUDITH GOMES', NULL, '2018-11-29', 2, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ensaiocorrentefuga`
--

CREATE TABLE `ensaiocorrentefuga` (
  `id` int(11) NOT NULL,
  `modoId` int(11) NOT NULL,
  `itemCorrenteFugaId` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `valorCa` decimal(10,0) DEFAULT NULL,
  `valorCc` decimal(10,0) DEFAULT NULL,
  `responsavel` text,
  `FichaTecnica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ensaiocorrentefuga`
--

INSERT INTO `ensaiocorrentefuga` (`id`, `modoId`, `itemCorrenteFugaId`, `data`, `valorCa`, `valorCc`, `responsavel`, `FichaTecnica_id`) VALUES
(317, 3, 1, '2017-11-21', '1200', '1100', 'DIEGO MASSANEIRO', 72),
(318, 3, 2, '2017-11-21', '1300', '1101', 'DIEGO MASSANEIRO', 72),
(359, 5, 1, '2017-11-27', '12', '23', 'DIEGO MASSANEIRO', 81),
(360, 5, 2, '2017-11-27', '0', '0', '  ', 81),
(361, 6, 1, '2017-11-27', '0', '0', '  ', 81),
(362, 6, 2, '2017-11-27', '0', '23', 'FELIPE MENDES', 81),
(369, 5, 1, '2017-11-27', '0', '0', '  ', 84),
(370, 5, 2, '2017-11-27', '0', '0', '  ', 84),
(371, 6, 1, '2017-11-27', '0', '0', '  ', 84),
(372, 6, 2, '2017-11-27', '0', '0', '  ', 84),
(377, 7, 1, '2017-11-29', '3', '3', 'DIEGO MASSANEIRO', 85),
(378, 7, 2, '2017-11-29', '4', '4', 'DIEGO MASSANEIRO', 85),
(379, 3, 1, '2017-11-27', '12312', '123', 'ALYSSON MARTIN', 75),
(380, 3, 1, '2017-11-27', '32423', '234', 'DIEGO MASSANEIRO', 75),
(381, 3, 2, '2017-11-27', '234', '234', 'JESSICA BARBOSA', 75),
(382, 3, 2, '2017-11-27', '456', '456', 'LUIS DANILO', 75),
(447, 1, 1, '2017-12-01', '100', '200', 'ALLAN GOMES ', 87),
(448, 1, 2, '2017-12-01', '255', '85', 'ALYSSON MARTIN', 87),
(449, 2, 1, '2017-12-01', '0', '0', '  ', 87),
(450, 2, 2, '2017-12-01', '0', '0', '  ', 87),
(451, 3, 1, '2017-12-01', '5', '15', '  ', 87),
(452, 3, 2, '2017-12-01', '51', '615', 'EDUARDO SANTIAGO', 87),
(453, 4, 1, '2017-12-01', '0', '0', '  ', 87),
(454, 4, 2, '2017-12-01', '3', '54', 'JESSICA BARBOSA', 87);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ensaiorigidezdieletrica`
--

CREATE TABLE `ensaiorigidezdieletrica` (
  `itemRigidezDieletricaId` int(11) NOT NULL,
  `data` date NOT NULL,
  `resultado` char(5) DEFAULT NULL,
  `correnteMa` int(11) DEFAULT NULL,
  `responsavel` text,
  `FichaTecnica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ensaiorigidezdieletrica`
--

INSERT INTO `ensaiorigidezdieletrica` (`itemRigidezDieletricaId`, `data`, `resultado`, `correnteMa`, `responsavel`, `FichaTecnica_id`) VALUES
(11, '2017-11-21', 'C', 3200, 'DIEGO MASSANEIRO', 72),
(11, '2017-11-27', 'C', 123, 'ALLAN GOMES ', 75),
(11, '2017-12-01', '', 0, '  ', 87),
(12, '2017-11-21', 'NC', 1800, 'EDUARDO SANTIAGO', 72),
(12, '2017-11-27', 'NC', 13, 'EDUARDO SANTIAGO', 75),
(12, '2017-12-01', '', 0, '  ', 87),
(15, '2017-11-27', 'C', 123, 'ALLAN GOMES ', 81),
(15, '2017-11-27', 'C', 0, '  ', 84),
(16, '2017-11-27', 'C', 123, 'EDUARDO SANTIAGO', 81),
(16, '2017-11-27', 'C', 0, 'FELIPE MENDES', 84),
(17, '2017-11-29', 'C', 120, 'EDUARDO SANTIAGO', 85);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sigla` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id`, `nome`, `sigla`) VALUES
(1, 'PARANÁ', 'PR'),
(2, 'SÃO PAULO', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fichatecnica`
--

CREATE TABLE `fichatecnica` (
  `id` int(11) NOT NULL,
  `numeroOrdem` int(11) NOT NULL,
  `numeriSerie` varchar(20) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `statusId` int(11) NOT NULL,
  `produtoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fichatecnica`
--

INSERT INTO `fichatecnica` (`id`, `numeroOrdem`, `numeriSerie`, `dataInicio`, `dataFim`, `statusId`, `produtoId`) VALUES
(72, 2017001, 'vt001', '2017-11-21', '2017-11-21', 1, 5),
(75, 123, '123', '2017-11-27', '2017-11-27', 3, 5),
(81, 123, '123', '2017-11-27', '2017-11-27', 3, 9),
(84, 123, '123', '2017-11-25', '2017-11-27', 3, 9),
(85, 4, '6', '2017-11-29', '2017-11-29', 3, 10),
(87, 123, '1312', '2017-12-01', '2017-12-01', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fichatecnicainstrumento`
--

CREATE TABLE `fichatecnicainstrumento` (
  `fichaTecnicaId` int(11) NOT NULL,
  `instrumentoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fichatecnicainstrumento`
--

INSERT INTO `fichatecnicainstrumento` (`fichaTecnicaId`, `instrumentoId`) VALUES
(72, 3),
(72, 6),
(75, 1),
(75, 6),
(81, 3),
(81, 6),
(84, 3),
(85, 1),
(87, 1),
(87, 3),
(87, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nomeFantasia` varchar(100) NOT NULL,
  `situacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `cnpj`, `nome`, `nomeFantasia`, `situacao`) VALUES
(1, '11.111.111/1111-11', 'FORNECEDOR TESTE', 'FORNECEDOR TESTE', 'A'),
(18, '22.222.222/2222-22', 'TESTE 2', 'AA', 'A'),
(19, '111.111.111111-12', 'JOSE', 'JOSE', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `dataCadastro` date NOT NULL,
  `setorId` int(11) NOT NULL,
  `situacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `sobrenome`, `sexo`, `dataCadastro`, `setorId`, `situacao`) VALUES
(1, 'DIEGO MASSANEIRO', 'Massaneiro', 'M', '2017-08-15', 1, 'A'),
(2, 'VANESSA RIBEIRO', 'Ribeiro', 'F', '2017-09-03', 2, 'A'),
(6, 'ALYSSON MARTIN', 'MARTIN', 'M', '2017-11-13', 5, 'A'),
(7, 'FELIPE MENDES', 'A', 'M', '2017-10-20', 1, 'A'),
(8, 'EDUARDO SANTIAGO', 'A', 'F', '2017-10-20', 4, 'A'),
(9, 'ALLAN GOMES ', '', 'F', '2017-11-16', 1, 'A'),
(10, 'LUIS DANILO', 'A', 'M', '2017-10-20', 4, 'A'),
(12, 'JESSICA BARBOSA', '', 'F', '2017-11-17', 3, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicoauditoria`
--

CREATE TABLE `historicoauditoria` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `auditoriaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicoauditoria`
--

INSERT INTO `historicoauditoria` (`id`, `data`, `funcionarioId`, `statusId`, `auditoriaId`) VALUES
(95, '2017-11-17 14:11:07', 10, 7, 38),
(96, '2017-11-17 14:11:47', 10, 6, 38),
(97, '2017-11-17 14:11:52', 10, 9, 38),
(98, '2017-11-17 14:11:59', 10, 9, 38),
(99, '2017-11-17 14:11:06', 10, 10, 38),
(100, '2017-11-17 14:11:10', 10, 6, 38),
(101, '2017-11-17 14:11:13', 10, 9, 38),
(102, '2017-11-21 12:11:04', 1, 6, 38),
(103, '2017-11-21 12:11:59', 1, 9, 38),
(104, '2017-11-21 12:11:49', 1, 10, 38),
(105, '2017-11-27 11:44:28', 1, 7, 39),
(106, '2017-11-27 11:45:34', 1, 6, 38),
(107, '2017-11-27 11:45:37', 1, 9, 38),
(108, '2017-11-27 11:45:44', 1, 10, 38),
(109, '2017-11-27 11:45:48', 1, 6, 39),
(110, '2017-11-27 11:45:51', 1, 9, 39),
(111, '2017-11-27 11:45:56', 1, 10, 39),
(112, '2017-11-27 12:07:26', 1, 6, 39),
(113, '2017-11-27 12:07:29', 1, 9, 39),
(114, '2017-11-27 12:07:33', 1, 10, 39),
(115, '2017-11-27 12:07:39', 1, 6, 39),
(116, '2017-11-27 12:07:42', 1, 9, 39),
(117, '2017-11-27 12:07:48', 1, 10, 39),
(118, '2017-11-27 12:10:40', 1, 7, 40),
(119, '2017-11-27 12:11:02', 1, 6, 40),
(120, '2017-11-27 12:11:04', 1, 9, 40),
(121, '2017-11-27 12:11:08', 1, 10, 40),
(122, '2017-11-27 12:12:41', 1, 6, 38),
(123, '2017-11-27 12:12:43', 1, 9, 38),
(124, '2017-11-27 12:13:49', 1, 10, 38),
(125, '2017-11-27 13:18:15', 1, 6, 40),
(126, '2017-11-27 13:18:17', 1, 9, 40),
(127, '2017-11-27 13:18:20', 1, 10, 40),
(128, '2017-11-27 13:21:26', 1, 6, 39),
(129, '2017-11-27 13:21:27', 1, 9, 39),
(130, '2017-11-27 13:21:32', 1, 10, 39),
(131, '2017-11-27 13:21:39', 1, 6, 39),
(132, '2017-11-27 13:21:42', 1, 9, 39),
(133, '2017-11-27 13:21:44', 1, 10, 39),
(134, '2017-11-28 10:19:36', 1, 6, 39),
(135, '2017-11-28 10:19:40', 1, 9, 39),
(136, '2017-11-28 10:19:44', 1, 10, 39),
(137, '2017-11-28 10:19:54', 1, 6, 39),
(138, '2017-11-28 10:19:56', 1, 9, 39),
(139, '2017-11-28 10:20:00', 1, 10, 39),
(140, '2017-11-28 10:25:40', 1, 7, 40),
(141, '2017-11-28 10:26:46', 1, 7, 42),
(142, '2017-11-28 10:26:54', 1, 7, 43),
(143, '2017-11-28 10:27:21', 1, 6, 42),
(144, '2017-11-28 10:27:25', 1, 9, 42),
(145, '2017-11-28 10:27:37', 1, 10, 42),
(146, '2017-11-28 10:27:52', 1, 6, 42),
(147, '2017-11-28 12:53:04', 1, 6, 43),
(148, '2017-11-28 12:53:07', 1, 9, 43),
(149, '2017-11-28 12:53:10', 1, 10, 43),
(150, '2017-11-28 13:15:10', 1, 6, 43),
(151, '2017-11-28 13:15:12', 1, 9, 43),
(152, '2017-11-28 13:15:15', 1, 10, 43),
(153, '2017-11-28 13:21:18', 1, 7, 44),
(154, '2017-11-28 13:21:52', 1, 6, 44),
(155, '2017-11-29 14:16:10', 9, 6, 43),
(156, '2017-11-29 14:16:14', 9, 9, 43),
(157, '2017-11-29 14:16:16', 9, 10, 43),
(158, '2017-11-29 14:17:07', 1, 6, 43),
(159, '2017-11-29 14:17:09', 1, 9, 43),
(160, '2017-11-29 14:17:12', 1, 10, 43),
(161, '2017-11-29 14:17:28', 1, 6, 44),
(162, '2017-11-29 14:17:32', 1, 9, 44),
(163, '2017-11-29 14:17:40', 1, 10, 44),
(164, '2017-11-29 14:18:00', 1, 6, 43),
(165, '2017-11-29 14:18:01', 1, 9, 43),
(166, '2017-11-29 14:18:07', 1, 10, 43),
(167, '2017-11-29 14:20:36', 9, 7, 45),
(168, '2017-11-29 14:27:22', 9, 6, 45),
(169, '2017-11-29 14:27:23', 9, 9, 45),
(170, '2017-11-29 14:27:32', 9, 10, 45),
(171, '2017-12-01 10:40:02', 1, 6, 45),
(172, '2017-12-01 10:40:09', 1, 9, 45),
(173, '2017-12-01 10:56:00', 1, 9, 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicoconformidadeproduto`
--

CREATE TABLE `historicoconformidadeproduto` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `statusId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `naoConformidadeProdutoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicoconformidadeproduto`
--

INSERT INTO `historicoconformidadeproduto` (`id`, `data`, `statusId`, `funcionarioId`, `naoConformidadeProdutoId`) VALUES
(1, '2017-09-07 00:00:00', 7, 1, 2),
(2, '2017-11-10 12:42:18', 7, 2, 3),
(3, '2017-11-21 12:34:37', 7, 1, 4),
(4, '2017-11-29 14:41:28', 7, 9, 5),
(5, '2017-12-01 09:43:01', 6, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicodocumentos`
--

CREATE TABLE `historicodocumentos` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `documentoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicodocumentos`
--

INSERT INTO `historicodocumentos` (`id`, `data`, `funcionarioId`, `statusId`, `documentoId`) VALUES
(60, '2017-11-17 14:11:41', 10, 7, 67),
(61, '2017-11-17 00:00:00', 10, 4, 67),
(62, '2017-11-17 14:11:39', 10, 6, 67),
(63, '2017-11-17 00:00:00', 10, 5, 67),
(64, '2017-11-21 12:11:43', 1, 7, 68),
(65, '2017-11-27 11:12:00', 1, 7, 69),
(66, '2017-11-27 11:12:12', 1, 11, 69),
(67, '2017-11-27 00:00:00', 1, 6, 69),
(68, '2017-11-27 11:13:45', 1, 6, 69),
(69, '2017-11-27 11:22:23', 1, 6, 69),
(70, '2017-11-28 10:31:07', 1, 4, 69),
(71, '2017-11-28 12:52:11', 2, 6, 69),
(72, '2017-11-28 12:52:21', 2, 6, 69),
(73, '2017-11-29 08:48:20', 1, 6, 69),
(74, '2017-11-29 14:29:45', 9, 7, 70),
(75, '2017-11-29 14:31:32', 9, 4, 70),
(76, '2017-11-29 14:32:06', 9, 11, 70),
(77, '2017-11-29 14:32:11', 9, 6, 70);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicofichatecnica`
--

CREATE TABLE `historicofichatecnica` (
  `id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statusId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `fichaTecnicaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicofichatecnica`
--

INSERT INTO `historicofichatecnica` (`id`, `data`, `statusId`, `funcionarioId`, `fichaTecnicaId`) VALUES
(80, '2017-11-21 14:11:50', 7, 1, 72),
(81, '2017-11-21 14:11:54', 12, 1, 72),
(82, '2017-11-21 14:11:11', 13, 1, 72),
(83, '2017-11-21 14:11:11', 14, 1, 72),
(84, '2017-11-21 14:11:23', 14, 1, 72),
(85, '2017-11-21 14:11:45', 15, 1, 72),
(86, '2017-11-21 14:11:40', 16, 1, 72),
(87, '2017-11-21 14:11:45', 1, 1, 72),
(88, '2017-11-21 14:11:51', 6, 1, 72),
(89, '2017-11-21 14:11:56', 14, 1, 72),
(90, '2017-11-21 14:11:06', 1, 1, 72),
(129, '2017-11-27 12:11:49', 7, 1, 75),
(130, '2017-11-27 12:11:46', 12, 1, 75),
(131, '2017-11-27 12:11:21', 12, 1, 75),
(132, '2017-11-27 12:11:48', 13, 1, 75),
(133, '2017-11-27 12:11:55', 13, 1, 75),
(134, '2017-11-27 12:11:31', 14, 1, 75),
(135, '2017-11-27 12:11:36', 14, 1, 75),
(136, '2017-11-27 12:11:52', 15, 1, 75),
(137, '2017-11-27 12:11:59', 15, 1, 75),
(138, '2017-11-27 12:11:24', 16, 1, 75),
(139, '2017-11-27 12:11:50', 16, 1, 75),
(140, '2017-11-27 12:11:17', 16, 1, 75),
(141, '2017-11-27 12:11:30', 16, 1, 75),
(142, '2017-11-27 12:11:16', 1, 1, 75),
(143, '2017-11-27 12:11:28', 1, 1, 75),
(144, '2017-11-27 12:11:56', 6, 1, 75),
(145, '2017-11-27 12:11:00', 14, 1, 75),
(146, '2017-11-27 12:11:11', 1, 1, 75),
(188, '2017-11-27 13:03:00', 7, 1, 81),
(189, '2017-11-27 13:03:04', 12, 1, 81),
(190, '2017-11-27 13:11:11', 13, 1, 81),
(191, '2017-11-27 13:11:18', 14, 1, 81),
(192, '2017-11-27 13:03:26', 15, 1, 81),
(193, '2017-11-27 13:11:33', 16, 1, 81),
(194, '2017-11-27 13:11:36', 1, 1, 81),
(209, '2017-11-27 14:18:00', 6, 1, 81),
(210, '2017-11-27 14:18:03', 19, 1, 81),
(211, '2017-11-27 14:18:23', 7, 1, 84),
(212, '2017-11-27 14:18:26', 12, 1, 84),
(213, '2017-11-27 14:25:20', 6, 1, 84),
(214, '2017-11-27 14:25:21', 19, 1, 84),
(215, '2017-11-27 14:25:28', 6, 1, 84),
(216, '2017-11-27 14:25:37', 1, 1, 84),
(217, '2017-11-27 14:29:01', 6, 1, 84),
(218, '2017-11-27 14:29:03', 19, 1, 84),
(219, '2017-11-27 14:29:53', 6, 1, 84),
(220, '2017-11-27 14:30:16', 1, 1, 84),
(221, '2017-11-27 14:32:58', 6, 1, 84),
(222, '2017-11-27 14:33:44', 6, 1, 84),
(223, '2017-11-27 14:33:46', 19, 1, 84),
(224, '2017-11-27 14:45:09', 6, 1, 84),
(225, '2017-11-27 14:45:11', 19, 1, 84),
(226, '2017-11-27 14:49:12', 6, 1, 84),
(227, '2017-11-27 14:50:09', 6, 1, 84),
(228, '2017-11-27 14:50:10', 19, 1, 84),
(229, '2017-11-27 14:51:08', 6, 1, 84),
(230, '2017-11-27 14:51:10', 19, 1, 84),
(231, '2017-11-27 14:51:32', 6, 1, 81),
(232, '2017-11-27 14:51:36', 19, 1, 81),
(233, '2017-11-27 14:56:14', 6, 1, 84),
(234, '2017-11-27 14:56:15', 19, 1, 84),
(235, '2017-11-28 12:24:00', 6, 1, 81),
(236, '2017-11-28 12:24:02', 19, 1, 81),
(237, '2017-11-28 12:24:11', 6, 1, 81),
(238, '2017-11-28 12:24:13', 19, 1, 81),
(239, '2017-11-28 15:12:17', 6, 1, 84),
(240, '2017-11-29 16:43:19', 7, 9, 85),
(241, '2017-11-29 16:44:02', 6, 9, 85),
(242, '2017-11-29 16:44:15', 19, 9, 85),
(243, '2017-11-29 16:44:51', 6, 9, 85),
(244, '2017-11-29 16:45:22', 20, 9, 85),
(245, '2017-11-29 16:45:48', 6, 9, 85),
(246, '2017-11-29 16:46:31', 21, 9, 85),
(247, '2017-11-29 16:47:07', 6, 9, 85),
(248, '2017-11-29 16:48:19', 6, 9, 85),
(249, '2017-11-29 16:48:42', 1, 9, 85),
(250, '2017-12-01 13:13:43', 6, 1, 85),
(251, '2017-12-01 13:26:50', 6, 1, 75),
(252, '2017-12-01 13:47:44', 6, 1, 75),
(264, '2017-12-01 14:11:47', 7, 1, 87),
(265, '2017-12-01 14:11:49', 12, 1, 87),
(266, '2017-12-01 14:11:50', 13, 1, 87),
(267, '2017-12-01 14:12:01', 14, 1, 87),
(268, '2017-12-01 14:31:07', 1, 1, 87),
(269, '2017-12-01 14:38:57', 1, 1, 87);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicolaudo`
--

CREATE TABLE `historicolaudo` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `statusId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `laudoInspecaoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicolaudo`
--

INSERT INTO `historicolaudo` (`id`, `data`, `statusId`, `funcionarioId`, `laudoInspecaoId`) VALUES
(9, '2017-10-05 19:32:49', 7, 1, 15),
(10, '2017-10-05 19:33:00', 6, 1, 15),
(11, '2017-10-05 19:33:08', 6, 1, 15),
(14, '2017-10-20 17:21:35', 7, 10, 16),
(35, '2017-11-21 12:54:03', 6, 1, 16),
(38, '2017-11-28 13:05:18', 7, 12, 19),
(39, '2017-11-28 13:05:36', 6, 12, 19),
(40, '2017-11-28 13:24:15', 7, 1, 20),
(44, '2017-12-01 12:43:22', 7, 1, 23),
(45, '2017-12-01 12:44:34', 6, 1, 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historiconaoconformidade`
--

CREATE TABLE `historiconaoconformidade` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `statusId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `naoConformidadeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historiconaoconformidade`
--

INSERT INTO `historiconaoconformidade` (`id`, `data`, `statusId`, `funcionarioId`, `naoConformidadeId`) VALUES
(1, '2017-09-29 12:31:47', 7, 1, 1),
(2, '2017-10-05 12:09:46', 6, 2, 1),
(3, '2017-11-21 12:31:21', 7, 1, 2),
(4, '2017-11-28 13:20:33', 7, 1, 3),
(5, '2017-12-01 09:25:09', 6, 1, 3),
(6, '2017-12-01 12:59:04', 7, 1, 4),
(7, '2017-12-01 13:00:20', 6, 1, 4),
(8, '2017-12-01 13:00:27', 6, 1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `instrumento`
--

CREATE TABLE `instrumento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `identificacao` varchar(45) NOT NULL,
  `dataValidade` date NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `instrumento`
--

INSERT INTO `instrumento` (`id`, `descricao`, `identificacao`, `dataValidade`, `situacao`) VALUES
(1, 'INSTRUMENTO 2', 'INS 005', '2018-11-27', 'A'),
(3, 'LUXIMETRO DIGITAL', 'INS-002', '2018-11-10', 'A'),
(6, 'MULTIMETRO DIGIAL', 'INS-0012', '2018-11-15', 'A'),
(7, 'DESCASCADOR', 'DASC-565', '2017-11-29', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemcorrentefuga`
--

CREATE TABLE `itemcorrentefuga` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemcorrentefuga`
--

INSERT INTO `itemcorrentefuga` (`id`, `descricao`, `situacao`) VALUES
(1, 'S1 I, S5 I, S4 I', 'A'),
(2, 'S1 I, S5 0, S4 I', 'A'),
(3, '32423423', 'I');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemliberacao`
--

CREATE TABLE `itemliberacao` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `produtoId` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemliberacao`
--

INSERT INTO `itemliberacao` (`id`, `descricao`, `produtoId`, `situacao`) VALUES
(1, 'Gabinete livre de riscos e manchas', 5, 'A'),
(2, 'ETIQUETA DE ADVERTÊNCIA ', 5, 'A'),
(28, 'Etiqueta indelével ANVISA (serial)', 5, 'A'),
(29, 'Etiqueta do cabo de alimentação', 5, 'A'),
(30, 'TESTE 9', 9, 'A'),
(31, 'TESTE 10', 9, 'A'),
(32, 'BATATA LIVRE', 10, 'A'),
(33, 'BATATA BOA', 10, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemmontagem`
--

CREATE TABLE `itemmontagem` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `produtoId` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemmontagem`
--

INSERT INTO `itemmontagem` (`id`, `descricao`, `produtoId`, `situacao`) VALUES
(1, 'PREPARAÇÃO DOS LEDS', 5, 'I'),
(2, 'PREPARAÇÃO DOS CABOS', 5, 'A'),
(3, 'CONEXÕES DO CABO NO LED RGB', 5, 'I'),
(4, 'CONEXÕES DO CABO NO LED 3MM', 5, 'I'),
(5, 'MONTAGEM DO GABINETE', 5, 'A'),
(12, 'MONTAGEM DO KIT LED RGB VITALITY', 8, 'A'),
(13, 'TESTE 1', 9, 'A'),
(14, 'TESTE 2', 9, 'A'),
(15, 'PLANTIO', 10, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemquestionario`
--

CREATE TABLE `itemquestionario` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `tipoAuditoriaId` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemquestionario`
--

INSERT INTO `itemquestionario` (`id`, `descricao`, `tipoAuditoriaId`, `situacao`) VALUES
(5, 'OS DOCUMENTOS ESTÃO ATUALIZADOS E DISPONÍVEIS NOS LOCAIS DE APLICAÇÃO E TODOS OS DOCUMENTOS DESNECESSÁRIOS OU OBSOLETOS SÃO RETIRADOS DE USO, OU PROTEGIDOS DE USO NÃO INTENCIONAL?', 3, 'I'),
(6, 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 5, 'A'),
(7, 'PONTUALIDADE DOS FUNCIONARIOS', 3, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemrigidezdieletrica`
--

CREATE TABLE `itemrigidezdieletrica` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `produtoId` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemrigidezdieletrica`
--

INSERT INTO `itemrigidezdieletrica` (`id`, `descricao`, `produtoId`, `situacao`) VALUES
(11, '3200 V ENTRE FASE/NEUTRO E CHAVE SELETORA', 5, 'A'),
(12, '3200 V ENTRE FASE/NEUTRO E CARCAÇA \"PONCE\"', 5, 'A'),
(13, '3200 V ENTRE FASE/NEUTRO E CARCAÇA ', 5, 'I'),
(14, '3200 V ENTRE FASE/NEUTRO E LED', 5, 'I'),
(15, 'TESTE 3', 9, 'A'),
(16, 'TESTE 4', 9, 'A'),
(17, 'BATATA DOCE', 10, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemteste`
--

CREATE TABLE `itemteste` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `produtoId` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itemteste`
--

INSERT INTO `itemteste` (`id`, `descricao`, `produtoId`, `situacao`) VALUES
(1, 'TESTE NA CHAVE', 5, 'A'),
(2, 'LUMINOSIDADE', 5, 'A'),
(3, 'TESTE 7', 9, 'A'),
(4, 'TESTE 8', 9, 'A'),
(5, 'REGA', 10, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `laudoinspecao`
--

CREATE TABLE `laudoinspecao` (
  `id` int(11) NOT NULL,
  `dataInspecao` date NOT NULL,
  `numeroNota` int(11) DEFAULT NULL,
  `numeroLote` varchar(11) DEFAULT NULL,
  `dataRecebimento` date NOT NULL,
  `quantidadeLote` int(11) DEFAULT NULL,
  `quantiadadeConforme` int(11) DEFAULT NULL,
  `quantidadeDefeito` int(11) DEFAULT NULL,
  `observacao` text,
  `statusId` int(11) NOT NULL,
  `fornecedorId` int(11) NOT NULL,
  `materiaPrimaId` int(11) NOT NULL,
  `criterios` text NOT NULL,
  `tipoInspecao1` char(1) NOT NULL,
  `tipoInspecao2` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `laudoinspecao`
--

INSERT INTO `laudoinspecao` (`id`, `dataInspecao`, `numeroNota`, `numeroLote`, `dataRecebimento`, `quantidadeLote`, `quantiadadeConforme`, `quantidadeDefeito`, `observacao`, `statusId`, `fornecedorId`, `materiaPrimaId`, `criterios`, `tipoInspecao1`, `tipoInspecao2`) VALUES
(15, '2017-10-06', 300, '10', '2017-10-06', 200, 30, 170, 'ASA', 5, 1, 7, 'A', 'A', '1'),
(16, '2017-10-20', 405, '2001', '2017-10-20', 200, 190, 10, '', 4, 1, 7, 'FUNCIONANDO PERFEITAMENTE, PASSANDO CORRENTE', 'A', '1'),
(19, '2017-11-28', 455, '12', '2017-11-28', 100, 90, 10, '', 4, 1, 7, 'ASDAD', '1', ''),
(20, '2017-11-28', 312, '21', '2017-11-28', 50, 20, 30, 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 4, 1, 7, 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 'A', '2'),
(23, '2017-12-01', 23423, '123', '2017-12-01', 123, 23, 100, '', 4, 1, 7, '2312', '1', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `liberacao`
--

CREATE TABLE `liberacao` (
  `ItemLiberacao_id` int(11) NOT NULL,
  `conferido` char(2) DEFAULT NULL,
  `FichaTecnica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `liberacao`
--

INSERT INTO `liberacao` (`ItemLiberacao_id`, `conferido`, `FichaTecnica_id`) VALUES
(1, 'S', 72),
(1, '', 75),
(1, 'S', 87),
(2, 'S', 72),
(2, '', 75),
(2, 'S', 87),
(28, 'S', 72),
(28, '', 75),
(28, 'N', 87),
(29, 'S', 72),
(29, '', 75),
(29, 'S', 87),
(30, 'S', 81),
(30, '', 84),
(31, 'S', 81),
(31, '', 84),
(32, 'S', 85),
(33, 'N', 85);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiaprima`
--

CREATE TABLE `materiaprima` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `dataCadastro` date NOT NULL,
  `situacao` char(1) NOT NULL,
  `fornecedorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `materiaprima`
--

INSERT INTO `materiaprima` (`id`, `nome`, `descricao`, `dataCadastro`, `situacao`, `fornecedorId`) VALUES
(7, 'BOTAO ON/OFF', 'USADO NO VITALITY<br />\r\nE NAO SEI MAIS<br />\r\n:D', '2017-09-30', 'A', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `telaId` int(11) NOT NULL,
  `telaNome` varchar(80) NOT NULL,
  `menuVinculado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modo`
--

CREATE TABLE `modo` (
  `id` int(11) NOT NULL,
  `descricao` text CHARACTER SET utf8 NOT NULL,
  `produtoId` int(11) NOT NULL,
  `situacao` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modo`
--

INSERT INTO `modo` (`id`, `descricao`, `produtoId`, `situacao`) VALUES
(1, 'CHAVE SELETORA', 5, 'A'),
(2, 'CARCAÇA \'PONCE\'', 5, 'A'),
(3, 'CARCAÇA \'VITALITY\'', 5, 'A'),
(4, 'LED', 5, 'A'),
(5, 'TESTE 5', 9, 'A'),
(6, 'TESTE 6', 9, 'A'),
(7, 'RAIZ', 10, 'A'),
(8, 'SUCULENTA', 10, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `montagem`
--

CREATE TABLE `montagem` (
  `itemMontafemId` int(11) NOT NULL,
  `data` date NOT NULL,
  `responsavel` text NOT NULL,
  `FichaTecnica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `montagem`
--

INSERT INTO `montagem` (`itemMontafemId`, `data`, `responsavel`, `FichaTecnica_id`) VALUES
(2, '2017-11-21', 'DIEGO MASSANEIRO', 72),
(2, '2017-11-27', 'ALYSSON MARTIN', 75),
(2, '2017-12-01', '  ', 87),
(5, '2017-11-21', 'LUIS DANILO', 72),
(5, '2017-11-27', 'FELIPE MENDES', 75),
(5, '2017-12-01', '  ', 87),
(13, '2017-11-27', 'ALYSSON MARTIN', 81),
(13, '2017-11-27', 'ALLAN GOMES ', 84),
(14, '2017-11-27', 'FELIPE MENDES', 81),
(14, '2017-11-27', 'FELIPE MENDES', 84),
(15, '2017-11-29', 'ALYSSON MARTIN', 85);

-- --------------------------------------------------------

--
-- Estrutura da tabela `naoconformidade`
--

CREATE TABLE `naoconformidade` (
  `id` int(11) NOT NULL,
  `dataEmissao` date NOT NULL,
  `descricao` text NOT NULL,
  `justificativa` text NOT NULL,
  `acaoExcutada` text NOT NULL,
  `gravidade` char(1) NOT NULL,
  `notificado` varchar(60) NOT NULL,
  `tipoNaoConformidadeId` int(11) NOT NULL,
  `setorId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `acaoCorretiva` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `naoconformidade`
--

INSERT INTO `naoconformidade` (`id`, `dataEmissao`, `descricao`, `justificativa`, `acaoExcutada`, `gravidade`, `notificado`, `tipoNaoConformidadeId`, `setorId`, `statusId`, `acaoCorretiva`) VALUES
(1, '2017-09-29', 'TESTE', 'TESTE', 'ASA', 'A', 'ASSA', 2, 4, 2, 'S'),
(2, '2017-11-21', 'PROCEDIMENTO TAL INCORRETO', 'NAO TEM<BR />\r\n', 'CONVERSA COM O FUNCIONARIO', 'B', 'DIEGO MASSANEIRO', 2, 4, 1, 'N'),
(3, '2017-11-28', 'DSFSDFDF', 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 'A', 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ', 2, 3, 2, 'S'),
(4, '2017-12-01', 'KLASMDKLASNDLK', 'ASKDNKJASNDçJKAS', 'AKDNJKASNDKJ', 'A', 'QKDL', 2, 1, 2, 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `naoconformidadeproduto`
--

CREATE TABLE `naoconformidadeproduto` (
  `id` int(11) NOT NULL,
  `dataEmissao` date NOT NULL,
  `descricao` text NOT NULL,
  `acaoExcutada` text NOT NULL,
  `destino` text NOT NULL,
  `responsavel` varchar(60) NOT NULL,
  `responsavel2` varchar(60) NOT NULL,
  `responsavel3` varchar(60) NOT NULL,
  `investigar` char(1) NOT NULL,
  `notificados` text NOT NULL,
  `statusId` int(11) NOT NULL,
  `tipoNaoConformidadeProdutoId` int(11) NOT NULL,
  `controle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `naoconformidadeproduto`
--

INSERT INTO `naoconformidadeproduto` (`id`, `dataEmissao`, `descricao`, `acaoExcutada`, `destino`, `responsavel`, `responsavel2`, `responsavel3`, `investigar`, `notificados`, `statusId`, `tipoNaoConformidadeProdutoId`, `controle`) VALUES
(2, '2017-09-07', '111', '111', '111', '111', '11', '111', 'S', '111', 2, 3, ''),
(3, '2017-11-10', 'DSFDSFDSFDS', 'FGGFGF', 'FFGD', 'FDSFDSDF', 'DSDFS', 'FGF', 'N', 'BGGH', 2, 2, '2123'),
(4, '2017-11-21', 'PRODUTO FOI ENVIADO COM DEFEITO PARA O CLIENTE NÃO LIGA', 'ENVIO DE OUTRO PRODUTO PARA O CLIENTE ', 'CONCERTO', 'DIEGO MASSANEIRO', 'DIEGO MASSANEIRO', 'DIEGO MASSANEIRO', 'S', 'TODOS DA PRODUÇÃO', 2, 2, 'vt001'),
(5, '2017-11-29', 'NAO E SUCULENTA', 'JOGUEI NO LIXO', 'JOSE', 'DIEGO', 'ALLAN', 'DIEGO', 'N', 'TODOS', 2, 2, '7');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `id` int(11) NOT NULL,
  `permissaoAcessoId` int(11) NOT NULL,
  `permissaoGrupoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissaoacesso`
--

CREATE TABLE `permissaoacesso` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `situacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissaogrupo`
--

CREATE TABLE `permissaogrupo` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissaogrupo`
--

INSERT INTO `permissaogrupo` (`id`, `descricao`) VALUES
(1, 'ADMIN'),
(2, 'GERENTE - PRODUÇÃO\r\n'),
(3, 'FUNCIONARIO - PRODUÇÃO'),
(4, 'GERENTE- COMPRAS\n'),
(5, 'FUNCIONARIO - COMPRAS\r\n'),
(6, 'GERENTE - QUALIDADE'),
(7, 'GERENTE - VENDAS'),
(8, 'FUNCIONARIO - VENDAS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8 NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `situacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `categoriaId`, `situacao`) VALUES
(5, 'VITALITY PONCE', ' ', 1, 'A'),
(8, 'KIT LED RGB VITALITY', 'BBBBB', 1, 'A'),
(9, 'TESTE', 'ASD', 1, 'A'),
(10, 'BATATA', 'SUCULENTA', 5, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtomateriaprima`
--

CREATE TABLE `produtomateriaprima` (
  `ProdutoId` int(11) NOT NULL,
  `MateriaPrimaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id`, `descricao`) VALUES
(1, 'TI'),
(2, 'VENDAS'),
(3, 'PRODUÇÃO'),
(4, 'QUALIDADE'),
(5, 'TESTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `descricao`) VALUES
(1, 'CONCLUIDO'),
(2, 'PENDENTE'),
(3, 'CANCELADO'),
(4, 'APROVADO'),
(5, 'REPROVADO'),
(6, 'ALTERAÇÃO'),
(7, 'CADASTRADO'),
(8, 'EXCLUIDO'),
(9, 'ALTERAÇÃO - QUESTIONÁRIO'),
(10, 'ALTERAÇÃO - RESULTADO'),
(11, 'EXCLUSÃO DE DOCUMENTO'),
(12, 'CADASTRO - MONTAGEM'),
(13, 'CADASTRO - RIGIDEZ DIELÉTRICA'),
(14, 'CADASTRO - CORRENTE DE FUGA'),
(15, 'CADASTRO - TESTE FUNCIONAL'),
(16, 'CADASTRO - INSTRUMENTOS'),
(17, 'CADASTRO - LIBERAÇÃO'),
(18, 'ALTERAÇÃO - RIGIDEZ DIELÉTRICA'),
(19, 'ALTERAÇÃO - MONTAGEM'),
(20, 'ALTERAÇÃO - CORRENTE DE FUGA'),
(21, 'ALTERAÇÃO - TESTE FUNCIONAL'),
(22, 'ALTERAÇÃO - INSTRUMENTOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sugestao`
--

CREATE TABLE `sugestao` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `auditoriaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tela`
--

CREATE TABLE `tela` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `titulo` char(1) NOT NULL,
  `permissaoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste`
--

CREATE TABLE `teste` (
  `itemTesteId` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `resultado` char(2) DEFAULT NULL,
  `responsavel` text,
  `observacao` text,
  `FichaTecnica_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `teste`
--

INSERT INTO `teste` (`itemTesteId`, `data`, `resultado`, `responsavel`, `observacao`, `FichaTecnica_id`) VALUES
(1, '2017-11-21', 'C', 'DIEGO MASSANEIRO', '', 72),
(1, '2017-11-27', 'C', 'ALYSSON MARTIN', '234', 75),
(1, '2017-12-01', 'NC', 'ALYSSON MARTIN', 'JKNKJBJASBD', 87),
(2, '2017-11-21', 'NC', 'EDUARDO SANTIAGO', 'VALOR ABAIXO DO ESPERADO', 72),
(2, '2017-11-27', 'C', 'JESSICA BARBOSA', '123', 75),
(2, '2017-12-01', 'C', 'EDUARDO SANTIAGO', 'AJDKASDAS', 87),
(3, '2017-11-27', 'NC', 'ALLAN GOMES ', '123', 81),
(3, '2017-11-27', 'C', '  ', 'AAAAAAAA', 84),
(4, '2017-11-27', 'NC', 'FELIPE MENDES', '123', 81),
(4, '2017-11-27', '', '  ', '', 84),
(5, '2017-11-29', 'C', 'DIEGO MASSANEIRO', '', 85);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `sigla` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `descricao`, `sigla`) VALUES
(3, 'FORMULÁRIO LISTRA MESTRA', 'F.L.M'),
(5, 'FORMULÁRIO', 'FORM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiponaoconformidade`
--

CREATE TABLE `tiponaoconformidade` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tiponaoconformidade`
--

INSERT INTO `tiponaoconformidade` (`id`, `descricao`) VALUES
(2, 'FUNCIONÁRIO\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiponaoconformidadeproduto`
--

CREATE TABLE `tiponaoconformidadeproduto` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tiponaoconformidadeproduto`
--

INSERT INTO `tiponaoconformidadeproduto` (`id`, `descricao`) VALUES
(1, 'MATÉRIA-PRIMA'),
(2, 'PRODUTO'),
(3, 'OUTROS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoquestao`
--

CREATE TABLE `tipoquestao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipoquestao`
--

INSERT INTO `tipoquestao` (`id`, `descricao`) VALUES
(3, '2 – REQUISITOS GERAIS DO SISTEMA DA QUALIDADE'),
(5, 'ÇÇÇÇÇÃÃÃÃÃÃ~´EÉÉÉÉ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treinamento`
--

CREATE TABLE `treinamento` (
  `id` int(11) NOT NULL,
  `localTreinamento` text NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `aplicador` text NOT NULL,
  `conteudo` text NOT NULL,
  `descricaoMetodo` text NOT NULL,
  `dataPrazo` date DEFAULT NULL,
  `dataVerificacao` date DEFAULT NULL,
  `evidencias` text,
  `eficaz` char(1) DEFAULT NULL,
  `statusId` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `responsavel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `treinamento`
--

INSERT INTO `treinamento` (`id`, `localTreinamento`, `dataInicio`, `dataFim`, `aplicador`, `conteudo`, `descricaoMetodo`, `dataPrazo`, `dataVerificacao`, `evidencias`, `eficaz`, `statusId`, `descricao`, `responsavel`) VALUES
(1, 'CAMPO MOURAO', '2017-10-18', '2017-10-18', 'DIEGO', 'NAO SEI NAO SEI<br />\r\nNAO SEU', 'FOI LEGAL', '2017-10-18', '2017-10-18', ' NAO TEM', 'S', 1, 'TECNICAS DE VENDAS', 'DIEGO MASSANEIRO'),
(9, 'PONCE', '2017-11-17', '2017-11-27', 'LUIS DANILO', 'UASHDUSAHDUSAHDUASHDUA', 'TESTE ESCRITO APLICADO APóS O TREINAMENTO', '2017-11-17', '2017-11-17', 'TESTE CORRIGIDO COM NOTA SATISFATóRIA', 'S', 3, 'NOVOS PROCEDIMENTOS DO SISTEMA DA QUALIDADE', 'LUIS DANILO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treinamentofuncionario`
--

CREATE TABLE `treinamentofuncionario` (
  `treinamentoId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `situacao` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `treinamentofuncionario`
--

INSERT INTO `treinamentofuncionario` (`treinamentoId`, `funcionarioId`, `situacao`) VALUES
(1, 1, 'C'),
(1, 2, 'C'),
(1, 6, 'C'),
(9, 1, 'C'),
(9, 2, 'C'),
(9, 6, 'C'),
(9, 7, 'C'),
(9, 9, 'C'),
(9, 10, 'C'),
(9, 12, 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(6) NOT NULL,
  `dataCadastro` date NOT NULL,
  `permissaoGrupoId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `dataCadastro`, `permissaoGrupoId`, `funcionarioId`) VALUES
(1, 'DIEGO', '123', '2017-11-28', 1, 1),
(2, 'VANESSA', '123', '2017-11-28', 3, 2),
(3, 'danilo', '123', '2017-11-28', 6, 10),
(4, 'jessica', '123', '2017-11-28', 2, 12),
(5, 'allan', '123', '2017-11-29', 1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anexotreinamento`
--
ALTER TABLE `anexotreinamento`
  ADD PRIMARY KEY (`treinamentoId`),
  ADD KEY `fk_AnexoTreinamento_Treinamentos1_idx` (`treinamentoId`);

--
-- Indexes for table `arquivo`
--
ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Arquivo_Documentos1_idx` (`documentoId`);

--
-- Indexes for table `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Auditoria_Setor1_idx` (`setorId`);

--
-- Indexes for table `auditoriaquestionario`
--
ALTER TABLE `auditoriaquestionario`
  ADD PRIMARY KEY (`auditoriaId`,`itemQuestionarioId`),
  ADD KEY `fk_Auditoria_has_ItemQuestionario_ItemQuestionario1_idx` (`itemQuestionarioId`),
  ADD KEY `fk_Auditoria_has_ItemQuestionario_Auditoria1_idx` (`auditoriaId`);

--
-- Indexes for table `avaliacaocriterio`
--
ALTER TABLE `avaliacaocriterio`
  ADD PRIMARY KEY (`avaliacaoFornecedorId`,`criterioFornecedorId`),
  ADD KEY `fk_AvaliacaoFornecedor_has_CriterioAvaliacao_CriterioAvalia_idx` (`criterioFornecedorId`),
  ADD KEY `fk_AvaliacaoFornecedor_has_CriterioAvaliacao_AvaliacaoForne_idx` (`avaliacaoFornecedorId`);

--
-- Indexes for table `avaliacaofornecedor`
--
ALTER TABLE `avaliacaofornecedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_AvaliacaoFornecedor_Fornecedor1_idx` (`Fornecedor_id`),
  ADD KEY `fk_AvaliacaoFornecedor_Status1_idx` (`statusId`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Cidade_Estado1_idx` (`estadoId`);

--
-- Indexes for table `criterioaprovacao`
--
ALTER TABLE `criterioaprovacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteriofornecedor`
--
ALTER TABLE `criteriofornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Documento_Status1_idx` (`statusId`),
  ADD KEY `fk_tipoDocumentoId` (`tipoDocumentoId`);

--
-- Indexes for table `ensaiocorrentefuga`
--
ALTER TABLE `ensaiocorrentefuga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_EnsaioCorrenteFuga_has_ItemCorrenteFuga_ItemCorrenteFuga_idx` (`itemCorrenteFugaId`),
  ADD KEY `fk_EnsaioItemCorrenteFuga_FichaTecnica1_idx` (`FichaTecnica_id`),
  ADD KEY `fk_modoId` (`modoId`),
  ADD KEY `itemCorrenteFugaId` (`itemCorrenteFugaId`) USING BTREE;

--
-- Indexes for table `ensaiorigidezdieletrica`
--
ALTER TABLE `ensaiorigidezdieletrica`
  ADD PRIMARY KEY (`itemRigidezDieletricaId`,`FichaTecnica_id`),
  ADD KEY `fk_EnsaioRigidezDieletrica_has_ItemRigidezDieletrica_ItemRi_idx` (`itemRigidezDieletricaId`),
  ADD KEY `fk_EnsaioItemRigidezDieletrica_FichaTecnica1_idx` (`FichaTecnica_id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fichatecnica`
--
ALTER TABLE `fichatecnica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_FichaTecnica_Status1_idx` (`statusId`),
  ADD KEY `fk_FichaTecnica_Produto1_idx` (`produtoId`);

--
-- Indexes for table `fichatecnicainstrumento`
--
ALTER TABLE `fichatecnicainstrumento`
  ADD PRIMARY KEY (`fichaTecnicaId`,`instrumentoId`),
  ADD KEY `fk_Instrumento_has_FichaTecnica_FichaTecnica1_idx` (`fichaTecnicaId`),
  ADD KEY `fk_Instrumento_has_FichaTecnica_Instrumento1_idx` (`instrumentoId`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Funcionario_Setor1_idx` (`setorId`);

--
-- Indexes for table `historicoauditoria`
--
ALTER TABLE `historicoauditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_HistoricoAuditoria_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_HistoricoAuditoria_Status1_idx` (`statusId`),
  ADD KEY `fk_HistoricoAuditoria_Auditoria1_idx` (`auditoriaId`);

--
-- Indexes for table `historicoconformidadeproduto`
--
ALTER TABLE `historicoconformidadeproduto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_HistoricoConformidadeProduto_Status1_idx` (`statusId`),
  ADD KEY `fk_HistoricoConformidadeProduto_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_HistoricoConformidadeProduto_NaoConformidadeProduto1_idx` (`naoConformidadeProdutoId`);

--
-- Indexes for table `historicodocumentos`
--
ALTER TABLE `historicodocumentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_HistoricoDocumentos_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_HistoricoDocumentos_Status1_idx` (`statusId`),
  ADD KEY `fk_HistoricoDocumentos_Documento1_idx` (`documentoId`);

--
-- Indexes for table `historicofichatecnica`
--
ALTER TABLE `historicofichatecnica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_HistoricoFichaTecnica_Status1_idx` (`statusId`),
  ADD KEY `fk_HistoricoFichaTecnica_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_fichaTecnicaIdd` (`fichaTecnicaId`);

--
-- Indexes for table `historicolaudo`
--
ALTER TABLE `historicolaudo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_HistoricoLaudo_Status1_idx` (`statusId`),
  ADD KEY `fk_HistoricoLaudo_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_HistoricoLaudo_LaudoInspecao1_idx` (`laudoInspecaoId`);

--
-- Indexes for table `historiconaoconformidade`
--
ALTER TABLE `historiconaoconformidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_HistoricoNaoConformidade_Status1_idx` (`statusId`),
  ADD KEY `fk_HistoricoNaoConformidade_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_HistoricoNaoConformidade_NaoConformidade1_idx` (`naoConformidadeId`);

--
-- Indexes for table `instrumento`
--
ALTER TABLE `instrumento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcorrentefuga`
--
ALTER TABLE `itemcorrentefuga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemliberacao`
--
ALTER TABLE `itemliberacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ItemLiberacao_Produto1_idx` (`produtoId`);

--
-- Indexes for table `itemmontagem`
--
ALTER TABLE `itemmontagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ItemMontagem_Produto1_idx` (`produtoId`);

--
-- Indexes for table `itemquestionario`
--
ALTER TABLE `itemquestionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ItemQuestionario_TipoAuditoria1_idx` (`tipoAuditoriaId`);

--
-- Indexes for table `itemrigidezdieletrica`
--
ALTER TABLE `itemrigidezdieletrica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ItemRigidezDieletrica_Produto1_idx` (`produtoId`);

--
-- Indexes for table `itemteste`
--
ALTER TABLE `itemteste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ItemTeste_Produto1_idx` (`produtoId`);

--
-- Indexes for table `laudoinspecao`
--
ALTER TABLE `laudoinspecao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_LaudoInspecao_Status1_idx` (`statusId`),
  ADD KEY `fk_LaudoInspecao_Fornecedor1_idx` (`fornecedorId`),
  ADD KEY `fk_LaudoInspecao_MateriaPrima1_idx` (`materiaPrimaId`);

--
-- Indexes for table `liberacao`
--
ALTER TABLE `liberacao`
  ADD PRIMARY KEY (`ItemLiberacao_id`,`FichaTecnica_id`),
  ADD KEY `fk_Liberacao_has_ItemLiberacao_ItemLiberacao1_idx` (`ItemLiberacao_id`),
  ADD KEY `fk_LiberacaoItemLiberacao_FichaTecnica1_idx` (`FichaTecnica_id`);

--
-- Indexes for table `materiaprima`
--
ALTER TABLE `materiaprima`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_MateriaPrima_Fornecedor1_idx` (`fornecedorId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Menu_Tela1_idx` (`telaId`,`telaNome`),
  ADD KEY `fk_Menu_Menu1_idx` (`menuVinculado`);

--
-- Indexes for table `modo`
--
ALTER TABLE `modo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prodito_id` (`produtoId`);

--
-- Indexes for table `montagem`
--
ALTER TABLE `montagem`
  ADD PRIMARY KEY (`itemMontafemId`,`FichaTecnica_id`),
  ADD KEY `fk_Montagem_has_ItemMontagem_ItemMontagem1_idx` (`itemMontafemId`),
  ADD KEY `fk_MontagemItem_FichaTecnica1_idx` (`FichaTecnica_id`);

--
-- Indexes for table `naoconformidade`
--
ALTER TABLE `naoconformidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_NaoConformidade_TipoNaoConformidade1_idx` (`tipoNaoConformidadeId`),
  ADD KEY `fk_NaoConformidade_Status1_idx` (`statusId`),
  ADD KEY `fk_NaoConformidade_Setor1_idx` (`setorId`);

--
-- Indexes for table `naoconformidadeproduto`
--
ALTER TABLE `naoconformidadeproduto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_NaoConformidadeProduto_Status1_idx` (`statusId`),
  ADD KEY `fk_NaoConformidadeProduto_TipoNaoConformidadeProduto1_idx` (`tipoNaoConformidadeProdutoId`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Permissao_PermissaoAcesso_idx` (`permissaoAcessoId`),
  ADD KEY `fk_Permissao_PermissaoGrupo1_idx` (`permissaoGrupoId`);

--
-- Indexes for table `permissaoacesso`
--
ALTER TABLE `permissaoacesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissaogrupo`
--
ALTER TABLE `permissaogrupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Produto_Categoria1_idx` (`categoriaId`);

--
-- Indexes for table `produtomateriaprima`
--
ALTER TABLE `produtomateriaprima`
  ADD PRIMARY KEY (`ProdutoId`,`MateriaPrimaId`),
  ADD KEY `fk_Produto_has_MateriaPrima_MateriaPrima1_idx` (`MateriaPrimaId`),
  ADD KEY `fk_Produto_has_MateriaPrima_Produto1_idx` (`ProdutoId`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sugestao`
--
ALTER TABLE `sugestao`
  ADD PRIMARY KEY (`id`,`auditoriaId`),
  ADD KEY `fk_sugestao_Auditoria1_idx` (`auditoriaId`);

--
-- Indexes for table `tela`
--
ALTER TABLE `tela`
  ADD PRIMARY KEY (`id`,`nome`),
  ADD KEY `fk_Tela_Permissao1_idx` (`permissaoId`);

--
-- Indexes for table `teste`
--
ALTER TABLE `teste`
  ADD PRIMARY KEY (`itemTesteId`,`FichaTecnica_id`),
  ADD KEY `fk_TesteFuncional_has_ItemTeste_ItemTeste1_idx` (`itemTesteId`),
  ADD KEY `fk_TesteItemTeste_FichaTecnica1_idx` (`FichaTecnica_id`);

--
-- Indexes for table `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiponaoconformidade`
--
ALTER TABLE `tiponaoconformidade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiponaoconformidadeproduto`
--
ALTER TABLE `tiponaoconformidadeproduto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipoquestao`
--
ALTER TABLE `tipoquestao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treinamento`
--
ALTER TABLE `treinamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Treinamentos_Status1_idx` (`statusId`);

--
-- Indexes for table `treinamentofuncionario`
--
ALTER TABLE `treinamentofuncionario`
  ADD PRIMARY KEY (`treinamentoId`,`funcionarioId`),
  ADD KEY `fk_Treinamentos_has_Funcionario_Funcionario1_idx` (`funcionarioId`),
  ADD KEY `fk_Treinamentos_has_Funcionario_Treinamentos1_idx` (`treinamentoId`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Usuario_PermissaoGrupo1_idx` (`permissaoGrupoId`),
  ADD KEY `fk_Usuario_Funcionario1_idx` (`funcionarioId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arquivo`
--
ALTER TABLE `arquivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `avaliacaofornecedor`
--
ALTER TABLE `avaliacaofornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `criterioaprovacao`
--
ALTER TABLE `criterioaprovacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `criteriofornecedor`
--
ALTER TABLE `criteriofornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `ensaiocorrentefuga`
--
ALTER TABLE `ensaiocorrentefuga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=455;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fichatecnica`
--
ALTER TABLE `fichatecnica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `historicoauditoria`
--
ALTER TABLE `historicoauditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
--
-- AUTO_INCREMENT for table `historicoconformidadeproduto`
--
ALTER TABLE `historicoconformidadeproduto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `historicodocumentos`
--
ALTER TABLE `historicodocumentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `historicofichatecnica`
--
ALTER TABLE `historicofichatecnica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT for table `historicolaudo`
--
ALTER TABLE `historicolaudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `historiconaoconformidade`
--
ALTER TABLE `historiconaoconformidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `instrumento`
--
ALTER TABLE `instrumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `itemcorrentefuga`
--
ALTER TABLE `itemcorrentefuga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `itemliberacao`
--
ALTER TABLE `itemliberacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `itemmontagem`
--
ALTER TABLE `itemmontagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `itemquestionario`
--
ALTER TABLE `itemquestionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `itemrigidezdieletrica`
--
ALTER TABLE `itemrigidezdieletrica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `itemteste`
--
ALTER TABLE `itemteste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `laudoinspecao`
--
ALTER TABLE `laudoinspecao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `materiaprima`
--
ALTER TABLE `materiaprima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modo`
--
ALTER TABLE `modo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `naoconformidade`
--
ALTER TABLE `naoconformidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `naoconformidadeproduto`
--
ALTER TABLE `naoconformidadeproduto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissaoacesso`
--
ALTER TABLE `permissaoacesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissaogrupo`
--
ALTER TABLE `permissaogrupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tela`
--
ALTER TABLE `tela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tiponaoconformidade`
--
ALTER TABLE `tiponaoconformidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tiponaoconformidadeproduto`
--
ALTER TABLE `tiponaoconformidadeproduto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipoquestao`
--
ALTER TABLE `tipoquestao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `treinamento`
--
ALTER TABLE `treinamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `anexotreinamento`
--
ALTER TABLE `anexotreinamento`
  ADD CONSTRAINT `fk_AnexoTreinamento_Treinamentos1` FOREIGN KEY (`treinamentoId`) REFERENCES `treinamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `arquivo`
--
ALTER TABLE `arquivo`
  ADD CONSTRAINT `fk_Arquivo_Documentos1` FOREIGN KEY (`documentoId`) REFERENCES `documento` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `fk_Auditoria_Setor1` FOREIGN KEY (`setorId`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `auditoriaquestionario`
--
ALTER TABLE `auditoriaquestionario`
  ADD CONSTRAINT `fk_Auditoria_has_ItemQuestionario_Auditoria1` FOREIGN KEY (`auditoriaId`) REFERENCES `auditoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Auditoria_has_ItemQuestionario_ItemQuestionario1` FOREIGN KEY (`itemQuestionarioId`) REFERENCES `itemquestionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacaocriterio`
--
ALTER TABLE `avaliacaocriterio`
  ADD CONSTRAINT `fk_AvaliacaoFornecedor_has_CriterioAvaliacao_AvaliacaoFornece1` FOREIGN KEY (`avaliacaoFornecedorId`) REFERENCES `avaliacaofornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AvaliacaoFornecedor_has_CriterioAvaliacao_CriterioAvaliacao1` FOREIGN KEY (`criterioFornecedorId`) REFERENCES `criteriofornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `avaliacaofornecedor`
--
ALTER TABLE `avaliacaofornecedor`
  ADD CONSTRAINT `fk_AvaliacaoFornecedor_Fornecedor1` FOREIGN KEY (`Fornecedor_id`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AvaliacaoFornecedor_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_Cidade_Estado1` FOREIGN KEY (`estadoId`) REFERENCES `estado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_tipoDocumentoId` FOREIGN KEY (`tipoDocumentoId`) REFERENCES `tipodocumento` (`id`);

--
-- Limitadores para a tabela `ensaiocorrentefuga`
--
ALTER TABLE `ensaiocorrentefuga`
  ADD CONSTRAINT `Fk_itemCorrentedeFugaId` FOREIGN KEY (`itemCorrenteFugaId`) REFERENCES `itemcorrentefuga` (`id`),
  ADD CONSTRAINT `fk_modoId` FOREIGN KEY (`modoId`) REFERENCES `modo` (`id`);

--
-- Limitadores para a tabela `ensaiorigidezdieletrica`
--
ALTER TABLE `ensaiorigidezdieletrica`
  ADD CONSTRAINT `fk_EnsaioItemRigidezDieletrica_FichaTecnica1` FOREIGN KEY (`FichaTecnica_id`) REFERENCES `fichatecnica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EnsaioRigidezDieletrica_has_ItemRigidezDieletrica_ItemRigi1` FOREIGN KEY (`itemRigidezDieletricaId`) REFERENCES `itemrigidezdieletrica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fichatecnica`
--
ALTER TABLE `fichatecnica`
  ADD CONSTRAINT `fk_FichaTecnica_Produto1` FOREIGN KEY (`produtoId`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FichaTecnica_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fichatecnicainstrumento`
--
ALTER TABLE `fichatecnicainstrumento`
  ADD CONSTRAINT `fk_Instrumento_has_FichaTecnica_FichaTecnica1` FOREIGN KEY (`fichaTecnicaId`) REFERENCES `fichatecnica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Instrumento_has_FichaTecnica_Instrumento1` FOREIGN KEY (`instrumentoId`) REFERENCES `instrumento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_Funcionario_Setor1` FOREIGN KEY (`setorId`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historicoauditoria`
--
ALTER TABLE `historicoauditoria`
  ADD CONSTRAINT `fk_HistoricoAuditoria_Auditoria1` FOREIGN KEY (`auditoriaId`) REFERENCES `auditoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoAuditoria_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoAuditoria_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historicoconformidadeproduto`
--
ALTER TABLE `historicoconformidadeproduto`
  ADD CONSTRAINT `fk_HistoricoConformidadeProduto_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoConformidadeProduto_NaoConformidadeProduto1` FOREIGN KEY (`naoConformidadeProdutoId`) REFERENCES `naoconformidadeproduto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoConformidadeProduto_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historicodocumentos`
--
ALTER TABLE `historicodocumentos`
  ADD CONSTRAINT `fk_HistoricoDocumentos_Documento1` FOREIGN KEY (`documentoId`) REFERENCES `documento` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoDocumentos_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoDocumentos_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historicofichatecnica`
--
ALTER TABLE `historicofichatecnica`
  ADD CONSTRAINT `fk_HistoricoFichaTecnica_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoFichaTecnica_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fichaTecnicaIdd` FOREIGN KEY (`fichaTecnicaId`) REFERENCES `fichatecnica` (`id`);

--
-- Limitadores para a tabela `historicolaudo`
--
ALTER TABLE `historicolaudo`
  ADD CONSTRAINT `fk_HistoricoLaudo_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoLaudo_LaudoInspecao1` FOREIGN KEY (`laudoInspecaoId`) REFERENCES `laudoinspecao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoLaudo_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historiconaoconformidade`
--
ALTER TABLE `historiconaoconformidade`
  ADD CONSTRAINT `fk_HistoricoNaoConformidade_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoNaoConformidade_NaoConformidade1` FOREIGN KEY (`naoConformidadeId`) REFERENCES `naoconformidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_HistoricoNaoConformidade_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemliberacao`
--
ALTER TABLE `itemliberacao`
  ADD CONSTRAINT `fk_ItemLiberacao_Produto1` FOREIGN KEY (`produtoId`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemmontagem`
--
ALTER TABLE `itemmontagem`
  ADD CONSTRAINT `fk_ItemMontagem_Produto1` FOREIGN KEY (`produtoId`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemquestionario`
--
ALTER TABLE `itemquestionario`
  ADD CONSTRAINT `fk_ItemQuestionario_TipoAuditoria1` FOREIGN KEY (`tipoAuditoriaId`) REFERENCES `tipoquestao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemrigidezdieletrica`
--
ALTER TABLE `itemrigidezdieletrica`
  ADD CONSTRAINT `fk_ItemRigidezDieletrica_Produto1` FOREIGN KEY (`produtoId`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itemteste`
--
ALTER TABLE `itemteste`
  ADD CONSTRAINT `fk_ItemTeste_Produto1` FOREIGN KEY (`produtoId`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `laudoinspecao`
--
ALTER TABLE `laudoinspecao`
  ADD CONSTRAINT `fk_LaudoInspecao_Fornecedor1` FOREIGN KEY (`fornecedorId`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LaudoInspecao_MateriaPrima1` FOREIGN KEY (`materiaPrimaId`) REFERENCES `materiaprima` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LaudoInspecao_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `liberacao`
--
ALTER TABLE `liberacao`
  ADD CONSTRAINT `fk_LiberacaoItemLiberacao_FichaTecnica1` FOREIGN KEY (`FichaTecnica_id`) REFERENCES `fichatecnica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Liberacao_has_ItemLiberacao_ItemLiberacao1` FOREIGN KEY (`ItemLiberacao_id`) REFERENCES `itemliberacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `materiaprima`
--
ALTER TABLE `materiaprima`
  ADD CONSTRAINT `fk_MateriaPrima_Fornecedor1` FOREIGN KEY (`fornecedorId`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_Menu_Menu1` FOREIGN KEY (`menuVinculado`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Menu_Tela1` FOREIGN KEY (`telaId`,`telaNome`) REFERENCES `tela` (`id`, `nome`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `modo`
--
ALTER TABLE `modo`
  ADD CONSTRAINT `fk_prodito_id` FOREIGN KEY (`produtoId`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `montagem`
--
ALTER TABLE `montagem`
  ADD CONSTRAINT `fk_MontagemItem_FichaTecnica1` FOREIGN KEY (`FichaTecnica_id`) REFERENCES `fichatecnica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Montagem_has_ItemMontagem_ItemMontagem1` FOREIGN KEY (`itemMontafemId`) REFERENCES `itemmontagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `naoconformidade`
--
ALTER TABLE `naoconformidade`
  ADD CONSTRAINT `fk_NaoConformidade_Setor1` FOREIGN KEY (`setorId`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NaoConformidade_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NaoConformidade_TipoNaoConformidade1` FOREIGN KEY (`tipoNaoConformidadeId`) REFERENCES `tiponaoconformidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `naoconformidadeproduto`
--
ALTER TABLE `naoconformidadeproduto`
  ADD CONSTRAINT `fk_NaoConformidadeProduto_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_NaoConformidadeProduto_TipoNaoConformidadeProduto1` FOREIGN KEY (`tipoNaoConformidadeProdutoId`) REFERENCES `tiponaoconformidadeproduto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `permissao`
--
ALTER TABLE `permissao`
  ADD CONSTRAINT `fk_Permissao_PermissaoAcesso` FOREIGN KEY (`permissaoAcessoId`) REFERENCES `permissaoacesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Permissao_PermissaoGrupo1` FOREIGN KEY (`permissaoGrupoId`) REFERENCES `permissaogrupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_Produto_Categoria1` FOREIGN KEY (`categoriaId`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtomateriaprima`
--
ALTER TABLE `produtomateriaprima`
  ADD CONSTRAINT `fk_Produto_has_MateriaPrima_MateriaPrima1` FOREIGN KEY (`MateriaPrimaId`) REFERENCES `materiaprima` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produto_has_MateriaPrima_Produto1` FOREIGN KEY (`ProdutoId`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sugestao`
--
ALTER TABLE `sugestao`
  ADD CONSTRAINT `fk_sugestao_Auditoria1` FOREIGN KEY (`auditoriaId`) REFERENCES `auditoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tela`
--
ALTER TABLE `tela`
  ADD CONSTRAINT `fk_Tela_Permissao1` FOREIGN KEY (`permissaoId`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `teste`
--
ALTER TABLE `teste`
  ADD CONSTRAINT `fk_TesteItemTeste_FichaTecnica1` FOREIGN KEY (`FichaTecnica_id`) REFERENCES `fichatecnica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_teste_id` FOREIGN KEY (`itemTesteId`) REFERENCES `itemteste` (`id`);

--
-- Limitadores para a tabela `treinamento`
--
ALTER TABLE `treinamento`
  ADD CONSTRAINT `fk_Treinamentos_Status1` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `treinamentofuncionario`
--
ALTER TABLE `treinamentofuncionario`
  ADD CONSTRAINT `fk_Treinamentos_has_Funcionario_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Treinamentos_has_Funcionario_Treinamentos1` FOREIGN KEY (`treinamentoId`) REFERENCES `treinamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Funcionario1` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_PermissaoGrupo1` FOREIGN KEY (`permissaoGrupoId`) REFERENCES `permissaogrupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
