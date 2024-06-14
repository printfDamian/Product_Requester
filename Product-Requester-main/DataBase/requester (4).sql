-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jul-2023 às 14:14
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `requester`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `local` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`, `local`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'Marc', NULL, 'marc@emoto.co.il', 'Tel Aviv, TA', '2023-07-05 12:43:05', NULL, NULL),
(28, 'Maïrevetea', NULL, 'mairevetea@hotmail.fr', 'Papeete, V', '2023-07-05 12:43:05', NULL, NULL),
(29, '1apache36', NULL, '1apache36@gmail.com', 'Charles City VA, United States', '2023-07-05 12:43:05', NULL, NULL),
(30, 'ghoces', NULL, 'ghoces@gmail.com', 'Santiago, RM', '2023-07-05 12:43:05', NULL, NULL),
(31, 'rich.kudel07', NULL, 'rich.kudel07@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(32, 'brekkeaviation', NULL, 'brekkeaviation@gmail.com', 'Devils Lake ND, United States', '2023-07-05 12:43:05', NULL, NULL),
(33, 'jesplumbingandmexhanical', NULL, 'jesplumbingandmexhanical@gmail.com', 'Salt Lake City UT, United States', '2023-07-05 12:43:05', NULL, NULL),
(34, 'robertrussell3636', NULL, 'robertrussell3636@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(35, 'svamanzi', NULL, 'svamanzi@gmail.com', 'Sarasota FL, United States', '2023-07-05 12:43:05', NULL, NULL),
(36, 'richardwilhelm3', NULL, 'richardwilhelm3@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(37, 'ricey808', NULL, 'ricey808@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(38, 'oguz.sagra', NULL, 'oguz.sagra@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(39, 'n8char', NULL, 'n8char@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(40, 'snowking9613', NULL, 'snowking9613@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(41, 'alfamatic_1', NULL, 'alfamatic_1@hotmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(42, 'rover1102.8tgv', NULL, 'rover1102.8tgv@icloud.com', '', '2023-07-05 12:43:05', NULL, NULL),
(43, 'baylo724', NULL, 'baylo724@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(44, 'tom.ken.michiels', NULL, 'tom.ken.michiels@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(45, 'perryjason624', NULL, 'perryjason624@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(46, 'shanemigs17', NULL, 'shanemigs17@gmail.com', '', '2023-07-05 12:43:05', NULL, NULL),
(47, 'mfhsjb', NULL, 'mfhsjb@gmail.com', 'passenger foot pegs for 2008 and a 2009 Kawasaki k', '2023-07-05 12:43:05', NULL, NULL),
(48, 'guevara6471', NULL, 'guevara6471@gmail.com', 'passenger pegs for 99 sx 380', '2023-07-05 12:43:05', NULL, NULL),
(49, 'joefayad214', NULL, 'joefayad214@gmail.com', 'passenger pegs for the 1997 cr250r', '2023-07-05 12:43:05', NULL, NULL),
(50, 'roberto.sabarigo', NULL, 'roberto.sabarigo@gmail.com', 'rear foot pegs for the husqvarna te 450 2010 model', '2023-07-05 12:43:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `votes` int(11) NOT NULL,
  `file` varchar(50) DEFAULT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `product_link` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `votes`, `file`, `status_id`, `client_id`, `product_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(109, 'passenger pegs for Surron Storm Bee', '', 0, '', 1, 27, '', '2023-07-06 14:16:38', NULL, NULL),
(110, 'Sherco 500 sm factory 2023', '', 0, '', 1, 28, '', '2023-07-06 14:16:38', NULL, NULL),
(111, 'passenger foot pegs for  Yamaha TTR 250', '', 0, '', 1, 29, '', '2023-07-06 14:16:38', NULL, NULL),
(112, 'passanger pegs for husaberg fe390 2012', '', 0, '', 1, 30, '', '2023-07-06 14:16:38', NULL, NULL),
(113, 'passenger pegs for fantic xe 125 from 2023', '', 0, '', 1, 31, '', '2023-07-06 14:16:38', NULL, NULL),
(114, 'passenger pegs for the 2023 Beta 500 RR-S', '', 0, '', 1, 32, '', '2023-07-06 14:16:38', NULL, NULL),
(115, 'two thousand and two x r six fifty r', '', 0, '', 1, 33, '', '2023-07-06 14:16:38', NULL, NULL),
(116, 'passenger pegs for Beta motorcycles', '', 0, '', 1, 34, '', '2023-07-06 14:16:38', NULL, NULL),
(117, 'passenger peg kit for Beta 498RR 2014', '', 0, '', 1, 35, '', '2023-07-06 14:16:38', NULL, NULL),
(118, 'passenger pegs 2001 Yamaha to 426f', '', 0, '', 1, 36, '', '2023-07-06 14:16:38', NULL, NULL),
(119, 'passenger pegs 2011 kx250f', '', 0, '', 1, 37, '', '2023-07-06 14:16:38', NULL, NULL),
(120, 'pessenger pegs froe the ktm freeride 350', '', 0, '', 1, 38, '', '2023-07-06 14:16:38', NULL, NULL),
(121, 'passenger rear foot pegs and brackets for my 2003 ', '', 1, '', 1, 39, '', '2023-07-06 15:30:19', NULL, NULL),
(122, 'passenger pegs for 2002 KTMs', '', 1, '', 1, 40, '', '2023-07-06 15:26:21', NULL, NULL),
(123, 'passenger pegs for beta motorcycles.', '', 0, '', 1, 41, '', '2023-07-06 14:16:38', NULL, NULL),
(124, 'triple clamps for 2015 KtM 690 enduro r', '', 0, '', 1, 42, '', '2023-07-06 14:16:38', NULL, NULL),
(125, 'passenger pegs for a 2016 rmz 450', '', 0, '', 1, 43, '', '2023-07-06 14:16:38', NULL, NULL),
(126, 'passenger pegs for the beta rr 390 model 2023', '', 0, '', 1, 44, '', '2023-07-06 14:16:38', NULL, NULL),
(127, 'passenger footpegs for a 2018 beta 430', '', 0, '', 1, 45, '', '2023-07-06 14:16:38', NULL, NULL),
(128, 'passenger pegs for honda CRF250 rally 2021', '', 0, '', 1, 46, '', '2023-07-06 14:16:38', NULL, NULL),
(129, 'passenger foot pegs for 2008 and a 2009 Kawasaki k', '', 0, '', 1, 47, '', '2023-07-06 14:16:38', NULL, NULL),
(130, 'passenger pegs for 99 sx 380', '', 0, '', 1, 48, '', '2023-07-06 14:16:38', NULL, NULL),
(131, 'passenger pegs for 1997 cr250r', '', 0, '', 1, 49, '', '2023-07-06 14:16:38', NULL, NULL),
(132, 'rear foot pegs for husqvarna te 450 2010 model', '', 0, '', 1, 50, '', '2023-07-06 14:16:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Por desenvolver', '2023-06-26 08:51:49', NULL, NULL),
(2, 'Desenvolvido', '2023-06-26 08:51:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `votos`
--

CREATE TABLE `votos` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `votos`
--

INSERT INTO `votos` (`id`, `client_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 32, 122, '2023-07-06 15:26:21', NULL, NULL),
(13, 32, 121, '2023-07-06 15:30:19', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_clients` (`client_id`),
  ADD KEY `products_states` (`status_id`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votos_clients` (`client_id`),
  ADD KEY `votos_products` (`product_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `votos`
--
ALTER TABLE `votos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `products_states` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `products_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Limitadores para a tabela `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `votos_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
