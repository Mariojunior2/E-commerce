-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/08/2025 às 04:05
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `e-commerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('cliente','admin','vendedor') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `telefone`, `cpf`, `email`, `senha`, `tipo_usuario`) VALUES
(1, 'João Silva', '11999999999', '123.456.789-00', 'joao@email.com', 'senha123', 'cliente'),
(4, 'Mario Gonzales', '+55 47 98896-2224', '142.704.589-50', 'mario.defreitasjr@gmail.com', '$2y$10$O4h1ROyUrNcWT35FRlCjqOwzHQ8zPpkVynTjnoDPdH0tCF4UMAnxu', 'vendedor'),
(5, 'Joao', '+55 47 98896-2224', '142.704.589-15', 'mario.minecraftjunior@gmail.com', '$2y$10$PHnsJEQca9h0O5cbSzYLXOPVbPE9nXeSWr2.xY4k1q2SnxXZfx8nq', 'vendedor'),
(6, 'Mario Gonzales', '+55 47 98896-2224', '142.704.589-57', 'mario.minecraftjunio4r@gmail.com', '$2y$10$z3MbP/tPTjVB7QaGDzotvOQUabTIl6z26Bmrk.QkloaphSMm5gARO', 'cliente'),
(7, 'aaa', '+55 47 98896-2224', '142.704.589-58', '123@email.com', '$2y$10$GBHZIizLsAYnsfbxpmZOguKS5eCEySxJNceezICZxiW14LTGxa5ru', 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(10) UNSIGNED NOT NULL,
  `id_produto` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `status_pedido` varchar(20) DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `compra`
--

INSERT INTO `compra` (`id_compra`, `id_produto`, `id_cliente`, `endereco`, `valor_total`, `quantidade`, `status_pedido`) VALUES
(1, 1, 1, 'Rua dos Patos, 123, São Paulo - SP', NULL, 1, 'Pendente'),
(2, 2, 1, 'Rua das Flores, 123, São Paulo - SP', NULL, 1, 'Pendente'),
(19, 16, 7, 'Rua engenheiro jose gome, 615', 2800.00, 20, 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id_vendedor` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome`, `preco`, `quantidade`, `descricao`, `imagem`, `id_vendedor`) VALUES
(1, 'Mouse Gamer', 140.50, 50, 'Mouse com LED RGB e 3200 DPI', NULL, NULL),
(2, 'Teclado Mecânico', 250.00, 30, 'Teclado com switches azuis e iluminação', NULL, NULL),
(4, 'Teclado Mecânico Redragon Kumara K552', 199.00, 0, 'Teclado compacto com switches mecânicos e LED vermelho', 'https://m.media-amazon.com/images/I/71kr3WAj1FL._AC_SX679_.jpg', NULL),
(5, 'Monitor Gamer AOC 24G2', 1049.90, 20, 'Monitor 24\" IPS, 144Hz, 1ms, Full HD com FreeSync', 'https://m.media-amazon.com/images/I/81r8JazBfqL._AC_SX679_.jpg', NULL),
(6, 'Headset Gamer HyperX Cloud Stinger', 279.90, 18, 'Headset leve com drivers de 50mm e microfone com cancelamento de ruído', 'https://m.media-amazon.com/images/I/61a1bPJQBuL._AC_SX679_.jpg', NULL),
(7, 'Mousepad Gamer Extra Grande', 79.90, 80, 'Mousepad com 80x30cm, superfície em tecido e base antiderrapante', 'https://m.media-amazon.com/images/I/71Y2hWix9wL._AC_SX679_.jpg', NULL),
(16, 'Mouse Gamer Logitech G203', 140.00, 80, 'Um mouse muito legal!', 'https://m.media-amazon.com/images/I/61LtuGzXeaL._AC_SX679_.jpg', 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_compra_produto` (`id_produto`),
  ADD KEY `fk_compra_cliente` (`id_cliente`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_produto_vendedor` (`id_vendedor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_compra_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE;

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
