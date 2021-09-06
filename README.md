# Teste_Dev_Tinnova

Testes realizados para a empresa Tinnova

Desenvolvidos em PHP, JS, CSS, SQL, Bootstrap e HTML

1) Eleitores
2) Bubble Sort
3) Fatorial
4) Multiplos de 3 ou 5
5) Cadastro de veículos

## Install

- Instalar xampp - verão minima 7.4.9
  PHP Version 7.4.9
- Instalar o composer
```bash
composer update --no-interaction --ansi
```

- Crias as tabelas no MySQL
  Estrutura da Tabela Veiculos (Teste 5)

```bash
CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `veiculo` varchar(40) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `ano` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `vendido` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;
```

  Estrutura da Tabela Votos (Teste 1)

```bash
CREATE TABLE `votos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;
```

- Configurar acesso ao banco de dados no aquivo source/config.php

## Usage

Todos os testes estão em uma unica aplicação, separados por paginas.

Cada exercicio tem seu Model e sua pagina

O Model fica dentro da pasta Models, com seus atributos funções e conexão com o banco de dados.

O caminho das rodas fica no arquivo index.php e o controlado na App/Web.php

Para utilizar as rodas e a comunicação com o banco de dados, utilizei da biblioteca coofecode, utilizada com o composer.

Que são:

coffeecode/router 1.0.*
coffeecode/datalayer 1.1.2

