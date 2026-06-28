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
git clone https://github.com/victornotaro1/E-commerce-CodeIgniter-4
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
php spark migrate

php spark serve
```

Acesse no navegador:

```
http://localhost:8080
```

## Banco de dados

INSERT

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `imagem`, `preco`, `estoque`, `created_at`, `updated_at`) VALUES
(35, 'Camiseta Healing Preta', 'Camiseta oversized na cor preta.', 'https://acdn-us.mitiendanube.com/stores/001/352/322/products/healing_preta_01-3575bb91644297f9b517727324948827-1024-1024.webp', 129.90, 17, NULL, '2026-06-27 22:39:09'),
(36, 'Boné Preto', 'Boné casual com ajuste traseiro.', 'https://acdn-us.mitiendanube.com/stores/001/352/322/products/bone_01_02-d7fd86c7aa222ca8d017818184055966-1024-1024.webp', 89.90, 15, NULL, NULL),
(37, 'Camiseta Happy Hour Off', 'Camiseta oversized na cor off-white.', 'https://acdn-us.mitiendanube.com/stores/001/352/322/products/happy_hour_off-3a1a824cc0fc393b9b17585827889586-1024-1024.webp', 139.90, 18, NULL, NULL),
(38, 'Short Marrom', 'Short casual marrom para uso diário.', 'https://acdn-us.mitiendanube.com/stores/001/352/322/products/shorts_marrom_01-fadcfb2313473970bb17653947361428-1024-1024.webp', 119.90, 25, NULL, NULL),
(39, 'Camiseta Jazz Preta', 'Camiseta preta estampada nas costas.', 'https://acdn-us.mitiendanube.com/stores/001/352/322/products/jazz_preta_costas-93ad745191626a88d617574421653439-1024-1024.webp', 149.90, 10, NULL, '2026-06-27 22:39:09');
```

## Observação

As imagens dos produtos são armazenadas como links no banco de dados e exibidas dinamicamente na aplicação.
