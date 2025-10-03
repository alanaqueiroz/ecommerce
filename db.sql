CREATE DATABASE IF NOT EXISTS `ecommerce`;
USE `ecommerce`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'demo', '*3055544BD641D0814B910C4ACA5799F51B80F460'),
(2, 'teste', '*54F70B7C45C0C6359C49B71D12ADE9C4422D8DC8');

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `entered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `client` (`id`, `name`, `date`, `entered`) VALUES
(1, 'nome', '2077-10-10', '2025-08-21 20:11:05');

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `click` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `item` (`id`, `name`, `phone`, `click`) VALUES
(1, 'Item 01', '0000-0001', 0),
(2, 'Item 02', '0000-0002', 0),
(3, 'Item 03', '0000-0003', 0),
(4, 'Item 04', '0000-0004', 0),
(5, 'Item 05', '0000-0005', 0),
(6, 'Item 06', '0000-0006', 0),
(7, 'Item 07', '0000-0007', 0),
(8, 'Item 08', '0000-0008', 0),
(9, 'Item 09', '0000-0009', 0),
(10, 'Item 10', '0000-0010', 0),
(11, 'Item 11', '0000-0011', 0),
(12, 'Item 12', '0000-0012', 0),
(13, 'Item 13', '0000-0013', 0),
(14, 'Item 14', '0000-0014', 0),
(15, 'Item 15', '0000-0015', 0);

CREATE TABLE `prod` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `prod` (`id`, `nome`, `preco`) VALUES
(1, 'caderno', 12.30);

ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `prod`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;