# Projeto Loja CodeIgniter 4

Este projeto é uma aplicação de uma loja virtual desenvolvida com o framework CodeIgniter 4, utilizando o padrão MVC e banco de dados MySQL.

O objetivo é praticar desenvolvimento web com PHP, manipulação de banco de dados e criação de interfaces dinâmicas.

## Funcionalidades

- Listagem de produtos
- Cadastro de produtos
- Visualização de produtos
- Carrinho de compras
- Controle de estoque
- Exibição de imagens por URL
- Interface simples com Bootstrap

## Tecnologias utilizadas

- PHP 8+
- CodeIgniter 4
- MySQL
- Bootstrap 5
- HTML
- CSS
- JavaScript

## Estrutura do projeto

```
app/
├── Controllers/
├── Models/
├── Views/
│   ├── layout/
│   ├── produtos/
│   └── carrinho/
public/
├── assets/
└── index.php
```

## Instalação

Clone o repositório:

```
git clone https://github.com/seu-usuario/seu-projeto.git
```

Entre na pasta:

```
cd seu-projeto
```

Instale as dependências:

```
composer install
```

Configure o ambiente:

Copie o arquivo `env` para `.env`:

```
cp env .env
```

Configure o banco de dados no arquivo `.env`:

```
database.default.hostname = localhost
database.default.database = nome_do_banco
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

Execute o servidor:

```
php spark serve
```

Acesse no navegador:

```
http://localhost:8080
```

## Banco de dados

Tabela de produtos:

```
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    imagem VARCHAR(255)
);
```

## Observação

As imagens dos produtos são armazenadas como links no banco de dados e exibidas dinamicamente na aplicação.
