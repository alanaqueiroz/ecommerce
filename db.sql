CREATE DATABASE IF NOT EXISTS `ecommerce`;
USE `ecommerce`;

CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `entered` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_produto_categoria` (`categoria`),
  CONSTRAINT `fk_produto_categoria`
    FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'demo', 'demo123'),
(2, 'teste', 'teste123');
  
INSERT INTO `client` (`id`, `name`, `date`, `entered`) VALUES
(1, 'nome', '2077-10-10', '2025-08-21 20:11:05');

INSERT INTO `categoria` (`id`, `nome`, `descricao`) VALUES
(1, 'Geral', 'Categoria padrão');

INSERT INTO `produto` (`id`, `nome`, `preco`, `categoria`) VALUES
(1, 'caderno', 12.30, 1);