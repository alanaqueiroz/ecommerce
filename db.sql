CREATE DATABASE IF NOT EXISTS ecommerce;
USE ecommerce;

CREATE TABLE account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    role ENUM('admin', 'client') NOT NULL DEFAULT 'client'
);

CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao VARCHAR(255) NOT NULL
);

CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria INT DEFAULT NULL,
    owner_id INT NOT NULL,
    KEY idx_produto_categoria (categoria),
    CONSTRAINT fk_produto_categoria
        FOREIGN KEY (categoria) REFERENCES categoria(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_produto_owner
        FOREIGN KEY (owner_id) REFERENCES account(id)
        ON DELETE CASCADE
);

INSERT INTO account (username, password, name, role) VALUES
('demo', 'demo123', 'Usuário Demo', 'admin'),
('teste', 'teste123', 'Usuário Teste', 'client');

INSERT INTO categoria (nome, descricao) VALUES
('Eletrônicos', 'Produtos eletrônicos em geral'),
('Papelaria', 'Materiais de escritório'),
('Roupas', 'Vestuário masculino e feminino'),
('Livros', 'Livros diversos de ficção e não-ficção');

INSERT INTO produto (nome, preco, categoria, owner_id) VALUES
('Smartphone X200', 1999.90, 1, 1),
('Fone de ouvido Bluetooth', 149.50, 1, 1),
('Caneta azul', 2.50, 2, 1),
('Blusa de algodão', 49.90, 3, 1),
('Calça jeans', 89.90, 3, 1),
('Livro: A Arte da Guerra', 29.90, 4, 1),
('Caderno 100 folhas', 15.00, 2, 1);