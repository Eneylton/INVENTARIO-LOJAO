-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Maio-2022 às 04:29
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_inventraio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nivel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nivel`) VALUES
(1, 'admin'),
(2, 'Assitente'),
(3, 'Coordenador'),
(4, 'Auxiliar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banco`
--

CREATE TABLE `banco` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `banco`
--

INSERT INTO `banco` (`id`, `nome`) VALUES
(1, 'BANCO DO BRASIL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `forma_pagamento_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `descricao`) VALUES
(1, 'Asssistente de Logística'),
(4, 'Supervisor de Operações Logísticas Interior'),
(5, 'Encarregada de Expedição'),
(6, 'Assistente da qualidade'),
(7, 'Auxiliar de Logística'),
(8, 'Diretora'),
(9, 'Assistente Financeiro'),
(10, 'Coordenadora de RH');

-- --------------------------------------------------------

--
-- Estrutura da tabela `catdespesas`
--

CREATE TABLE `catdespesas` (
  `id` int(11) NOT NULL,
  `nome` varchar(105) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `catdespesas`
--

INSERT INTO `catdespesas` (`id`, `nome`) VALUES
(1, 'AGUA MINERAL GALAO 20L'),
(2, 'EQUATORIAL - ENERGIA'),
(3, 'FORNECEDOR- ENZO FOLHEADOS'),
(15, 'VENDAS'),
(16, 'ALUGUEL'),
(17, 'INTERNET'),
(18, 'SALARIO ELIAS JUNIOR'),
(19, 'PASSAGEM DE TRANSPORTE - TANIA'),
(20, 'FORNECEDOR - MISSMAKE- MAQUIAGEM'),
(21, 'EVENTUALIADADES'),
(22, 'MATERIAL LIMPEZA/ESCRITORIO'),
(23, 'FORNECEDOR - ILHAMAKE -MAQUIAGEM'),
(24, 'DAS - IMPOSTO '),
(25, 'EMPRESTIMO- BB'),
(26, 'TARIFA BANCARIA'),
(27, 'ESTORNO -PRODUTO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `foto` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `foto`) VALUES
(114, 'TERMINAL de direção', ''),
(115, 'suporte barra tensora ', ''),
(116, 'amortecedor', ''),
(117, 'reservatorio agua', ''),
(118, 'lampada ', ''),
(119, 'bieleta', ''),
(120, 'batedor', ''),
(121, 'filtro ar motor', ''),
(122, 'pastilha de freio', ''),
(123, 'Adicionar categorias', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cep` varchar(45) DEFAULT NULL,
  `localidade` varchar(45) DEFAULT NULL,
  `logradouro` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `uf` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `data`, `nome`, `telefone`, `email`, `cep`, `localidade`, `logradouro`, `numero`, `bairro`, `complemento`, `uf`) VALUES
(18, '2022-01-16 13:09:11', 'CLIENTE', '(98) 99158-1962', 'cliente@hotmail.com', '65054530', 'São Luís', 'Rua Três', '14', 'Cohatrac IV', 'Proximo a praça verão', 'MA'),
(19, '2022-05-15 20:47:38', 'MARIA DE JOÃO', '(98) 99158-1962', 'eneylton@hotmail.com', '65054700', 'São Luís', 'Rua Treze', '14', 'Cohatrac III', 'Proximo a praça verão', 'MA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `codigo` varchar(45) DEFAULT NULL,
  `barra` varchar(45) DEFAULT NULL,
  `nome` varchar(225) DEFAULT NULL,
  `qtd` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `produtos_id` int(10) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deposito`
--

CREATE TABLE `deposito` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `data1` timestamp NULL DEFAULT current_timestamp(),
  `valor` decimal(10,2) DEFAULT NULL,
  `forma_pagamento_id` int(11) NOT NULL,
  `banco_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `deposito`
--

INSERT INTO `deposito` (`id`, `data`, `data1`, `valor`, `forma_pagamento_id`, `banco_id`) VALUES
(1, '2022-02-14', '2022-02-14 20:09:19', '150.00', 2, 1),
(2, '2022-02-16', '2022-02-16 12:44:11', '0.00', 2, 1),
(3, '2022-02-17', '2022-02-17 21:12:04', '2.00', 2, 1),
(4, '2022-02-18', '2022-02-18 11:32:28', '35.00', 2, 1),
(5, '2022-02-19', '2022-02-19 20:58:46', '46.00', 2, 1),
(6, '2022-02-21', '2022-02-21 22:00:59', '37.00', 2, 1),
(7, '2022-02-23', '2022-02-23 11:54:51', '50.00', 2, 1),
(8, '2022-02-24', '2022-02-24 22:17:11', '35.00', 2, 1),
(9, '2022-02-22', '2022-02-22 12:42:26', '35.00', 2, 1),
(10, '2022-02-25', '2022-02-25 19:02:08', '2.00', 2, 1),
(11, '2022-02-26', '2022-02-26 19:02:37', '32.00', 2, 1),
(12, '2022-03-04', '2022-03-04 22:20:50', '13.00', 2, 1),
(13, '2022-03-03', '2022-03-03 12:49:40', '5.00', 2, 1),
(14, '2022-03-05', '2022-03-05 12:50:34', '27.00', 2, 1),
(15, '2022-02-27', '2022-02-27 12:51:49', '9.00', 2, 1),
(17, '2022-03-07', '2022-03-07 12:16:04', '14.00', 2, 1),
(18, '2022-03-08', '2022-03-08 12:16:56', '53.00', 2, 1),
(19, '2022-03-09', '2022-03-09 22:15:08', '26.00', 2, 1),
(20, '2022-03-10', '2022-03-10 12:05:23', '19.00', 2, 1),
(21, '2022-03-11', '2022-03-11 21:50:57', '63.50', 2, 1),
(22, '2022-03-12', '2022-03-12 21:54:59', '23.00', 2, 1),
(23, '2022-03-14', '2022-03-14 21:50:36', '60.00', 2, 1),
(24, '2022-03-15', '2022-03-15 22:07:59', '13.00', 2, 1),
(25, '2022-03-16', '2022-03-16 22:15:02', '26.00', 2, 1),
(26, '2022-03-17', '2022-03-17 14:31:14', '9.00', 2, 1),
(27, '2022-03-18', '2022-03-18 14:31:46', '153.00', 2, 1),
(28, '2022-03-19', '2022-03-19 14:32:32', '30.00', 2, 1),
(29, '2022-03-22', '2022-03-22 14:33:26', '18.00', 2, 1),
(30, '2022-03-23', '2022-03-23 11:38:38', '7.00', 2, 1),
(31, '2022-03-24', '2022-03-24 18:42:00', '5.00', 2, 1),
(32, '2022-03-25', '2022-03-25 22:17:27', '24.00', 2, 1),
(33, '2022-03-26', '2022-03-26 21:57:37', '36.00', 2, 1),
(34, '2022-03-28', '2022-03-28 21:58:01', '12.00', 2, 1),
(35, '2022-03-30', '2022-03-30 21:39:05', '24.00', 2, 1),
(36, '2022-04-01', '2022-04-01 11:35:58', '21.00', 2, 1),
(37, '2022-04-02', '2022-04-02 11:36:27', '41.00', 2, 1),
(38, '2022-04-03', '2022-04-03 11:36:58', '6.00', 2, 1),
(39, '2022-04-04', '2022-04-04 11:37:34', '3.00', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fechamento`
--

CREATE TABLE `fechamento` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `caixa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`id`, `nome`) VALUES
(2, 'Dinheiro'),
(3, 'Cartao de Credito 1x'),
(4, 'Cartao de Credito 2x'),
(5, 'Cartao de Credito 3x'),
(6, 'Cartao de Credito 4x'),
(7, 'Cartao de debito'),
(8, 'Pix');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `email`, `telefone`) VALUES
(1, 'Fornecedor 1', 'for@gmail.com', '989959'),
(2, 'Fornecedor 2', 'for@gmail.com', '98989898');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `troco` decimal(10,2) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `descricao` varchar(335) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `catdespesas_id` int(11) NOT NULL,
  `forma_pagamento_id` int(11) NOT NULL,
  `caixa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mov_cat`
--

CREATE TABLE `mov_cat` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mov_cat`
--

INSERT INTO `mov_cat` (`id`, `nome`) VALUES
(1, 'Venda de produtos'),
(2, 'Alimentação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notafiscal`
--

CREATE TABLE `notafiscal` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `chave` varchar(225) DEFAULT NULL,
  `valoricms` decimal(10,2) DEFAULT NULL,
  `autorizacao` int(11) DEFAULT NULL,
  `notafiscal` int(11) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `razaosocial` varchar(225) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `inscricaoestadual` varchar(45) DEFAULT NULL,
  `bcicms` decimal(10,2) DEFAULT NULL,
  `totalproduto` decimal(10,2) DEFAULT NULL,
  `frete` decimal(10,2) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `totalipi` decimal(10,2) DEFAULT NULL,
  `totalnota` decimal(10,2) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notafiscal`
--

INSERT INTO `notafiscal` (`id`, `data`, `chave`, `valoricms`, `autorizacao`, `notafiscal`, `serie`, `razaosocial`, `cnpj`, `inscricaoestadual`, `bcicms`, `totalproduto`, `frete`, `desconto`, `totalipi`, `totalnota`, `usuarios_id`) VALUES
(1, '2022-05-26 02:04:12', '0', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcelas`
--

CREATE TABLE `parcelas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `parcela` varchar(45) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `notafiscal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `codigo` int(11) DEFAULT NULL,
  `barra` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `qtd` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `subtotal` varchar(45) DEFAULT NULL,
  `produtos_id` int(10) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `ncm` varchar(45) DEFAULT NULL,
  `cfop` varchar(45) DEFAULT NULL,
  `un` varchar(45) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `valor_uni` decimal(10,2) DEFAULT NULL,
  `bc_icms` decimal(10,2) DEFAULT NULL,
  `valor_icms` decimal(10,2) DEFAULT NULL,
  `valor_ipi` decimal(10,2) DEFAULT NULL,
  `barra` varchar(45) DEFAULT NULL,
  `aplicacao` varchar(45) DEFAULT NULL,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `valor_venda` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ipi` varchar(45) DEFAULT NULL,
  `icms` varchar(45) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `categorias_id` int(11) NOT NULL,
  `notafiscal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_venda`
--

CREATE TABLE `produto_venda` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `produtos_id` int(10) NOT NULL,
  `clientes_id` int(11) NOT NULL,
  `forma_pagamento_id` int(11) NOT NULL,
  `movimentacoes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `nome`) VALUES
(0, 'Despesa'),
(1, 'Receita');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargos_id` int(11) NOT NULL,
  `acessos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cargos_id`, `acessos_id`) VALUES
(4, 'admin', 'admin@eneylton.com', '$2y$10$mZ.QuTVOWHefiG58kSk2K.BW3VDnDFu/l1fhYaBmRhQ5eJTJImThm', 1, 1),
(7, 'Eneylton Barros', 'eneylton@hotmail.com', '$2y$10$JZR7X2ZpplGhF4dtchAhJedF/Y0/4ynAOd8VBlR4ehJfLOKHX4mLG', 1, 2),
(13, 'ene', 'enex@gmail.com.br', '202cb962ac59075b964b07152d234b70', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp(),
  `codigo` int(11) DEFAULT NULL,
  `recebido` decimal(10,2) DEFAULT NULL,
  `troco` decimal(10,2) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `clientes_id` int(11) NOT NULL,
  `forma_pagamento_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `mov_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caixa_forma_pagamento1_idx` (`forma_pagamento_id`),
  ADD KEY `fk_caixa_usuarios1_idx` (`usuarios_id`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `catdespesas`
--
ALTER TABLE `catdespesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compras_produtos1_idx` (`produtos_id`),
  ADD KEY `fk_compras_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_compras_fornecedor1_idx` (`fornecedor_id`);

--
-- Índices para tabela `deposito`
--
ALTER TABLE `deposito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_deposito_forma_pagamento1_idx` (`forma_pagamento_id`),
  ADD KEY `fk_deposito_banco1_idx` (`banco_id`);

--
-- Índices para tabela `fechamento`
--
ALTER TABLE `fechamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fechamento_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_fechamento_caixa1_idx` (`caixa_id`);

--
-- Índices para tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movimentacoes_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_movimentacoes_catdespesas1_idx` (`catdespesas_id`),
  ADD KEY `fk_movimentacoes_forma_pagamento1_idx` (`forma_pagamento_id`),
  ADD KEY `fk_movimentacoes_caixa1_idx` (`caixa_id`);

--
-- Índices para tabela `mov_cat`
--
ALTER TABLE `mov_cat`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notafiscal`
--
ALTER TABLE `notafiscal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notafiscal_usuarios1_idx` (`usuarios_id`);

--
-- Índices para tabela `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parcelas_notafiscal1_idx` (`notafiscal_id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedidos_produtos1_idx` (`produtos_id`),
  ADD KEY `fk_pedidos_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_pedidos_fornecedor1_idx` (`fornecedor_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtos_categorias1_idx` (`categorias_id`),
  ADD KEY `fk_produtos_notafiscal1_idx` (`notafiscal_id`);

--
-- Índices para tabela `produto_venda`
--
ALTER TABLE `produto_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_venda_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_produto_venda_forma_pagamento1_idx` (`forma_pagamento_id`),
  ADD KEY `fk_produto_venda_movimentacoes1_idx` (`movimentacoes_id`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuarios_cargos_idx` (`cargos_id`),
  ADD KEY `fk_usuarios_acessos1_idx` (`acessos_id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vendas_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_vendas_clientes1_idx` (`clientes_id`),
  ADD KEY `fk_vendas_forma_pagamento1_idx` (`forma_pagamento_id`),
  ADD KEY `fk_vendas_tipo1_idx` (`tipo_id`),
  ADD KEY `fk_vendas_mov_cat1_idx` (`mov_cat_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `banco`
--
ALTER TABLE `banco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `catdespesas`
--
ALTER TABLE `catdespesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `deposito`
--
ALTER TABLE `deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `fechamento`
--
ALTER TABLE `fechamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT de tabela `mov_cat`
--
ALTER TABLE `mov_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `notafiscal`
--
ALTER TABLE `notafiscal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produto_venda`
--
ALTER TABLE `produto_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `fk_caixa_forma_pagamento1` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_caixa_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_fornecedor1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `deposito`
--
ALTER TABLE `deposito`
  ADD CONSTRAINT `fk_deposito_banco1` FOREIGN KEY (`banco_id`) REFERENCES `banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deposito_forma_pagamento1` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fechamento`
--
ALTER TABLE `fechamento`
  ADD CONSTRAINT `fk_fechamento_caixa1` FOREIGN KEY (`caixa_id`) REFERENCES `caixa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fechamento_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD CONSTRAINT `fk_movimentacoes_caixa1` FOREIGN KEY (`caixa_id`) REFERENCES `caixa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimentacoes_catdespesas1` FOREIGN KEY (`catdespesas_id`) REFERENCES `catdespesas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimentacoes_forma_pagamento1` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimentacoes_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `notafiscal`
--
ALTER TABLE `notafiscal`
  ADD CONSTRAINT `fk_notafiscal_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_fornecedor1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_acessos1` FOREIGN KEY (`acessos_id`) REFERENCES `acessos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_cargos` FOREIGN KEY (`cargos_id`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
