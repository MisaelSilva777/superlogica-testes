# Superlógica testes

Este repositório foi construido na finalidade de possuir os três exercícios solicitados como teste.
Basicamente na raiz temos o exercício número um, referente a um formulário de usuários.

Dentro da raiz vamos poder encontrar os outros dois exercícios, um referente a lógica na linguagem PHP (exercicio_2) e um segundo referente ao manejo de um banco de dados (exercicio_3).

# exercício 1
### Ambiente e instalação

A aplicação construida é containerizada, ou seja, temos um container com uma imagem php+apache para ser nosso servidor PHP, junto de dois outros containers com o MySQL 8 e PhpMyAdmin. No paragrafo abaixo está escrito um dos motivos pela decisão da utilização do Docker:

"Docker é uma tecnologia de virtualização que possibilita o empacotamento de uma aplicação ou ambiente inteiro dentro de um contêiner. O Docker foi criado com o objetivo de facilitar o desenvolvimento, acelerar a implantação e a execução de aplicações em ambientes isolados. Ele foi desenhado especialmente para disponibilizar aplicações da forma mais rápida possível, apoiado pelo modelo DevOps. Com os principais pontos positivos de oferecer portabilidade, agilidade, escalabilidade, controle e isolamento em todo o fluxo entre o Desenvolvimento e Operações. É uma das principais tendências do mercado nos dias de hoje, sendo utilizado por empresas como Uber, General Eletric, Ebay, Spotify e PayPal." - globalmind.

Para instanciar a aplicação é necessário apenas executar:

```bash
docker-compose up
```

Esse comando será responsável por baixar as imagens de cada container e buildar os serviços.

Em seguida basta executar

```bash
yarn install
``` 
e
```bash
 composer install
``` 

dentro da pasta app para instalação das dependências.

### Configuração dos containers

Servidor PHP rodando na porta 80, exemplo localhost ou localhost:80

- php-server - image: webdevops/php-apache:8.1-alpine

Banco de dados MySQL versão 8 rodando na porta 3606, usuário root e senha root

- mysql - image: mysql:8.0

PhpMyAdmin foi instalado para facilitar o desenvolvimento, sendo possível acessar por localhost:8080
- phpmyadmin-server - image: phpmyadmin/phpmyadmin

Pelo fatos de todos estarem associados na mesma network, então podemos conectar no banco de dados mysql pelo servidor php setando o host como mysql, ou seja, informando o nome do container.


## ENV

Como variáveis globais, tenho as que são usadas para conexão com banco de dados e outra para definir o path inicial da api. Sendo index.php

- PATH_API=index.php
- DB_HOST=mysql
- DB_DTBS=users
- DB_USER=root
- DB_PASS=root

## Qualidade de escrita

Para manter uma qualidade de escrita no código também implementei o PHP Code Sniffer com algumas rules definidas no arquivo xml, com comandos personalizados no package.json. Para que eu rodasse o PHPcs para validar o código a partir do comando ‘yarn lint’ e outro PHPCbf para corrigir a partir de ‘yarn lint-fix’.

Por questões de tempo, não implementei a execução de um Hook de pré commit do git para que rodasse o comando do yarn lint antes de commitar algo na Branch e garantisse que o código escrito estivesse de acordo com as rules do phpcs (claro que também teria de ter algo no lado do CI para evitar merges com erros de phpcs). 

## API

No desenvolvimento desse exercício resolvi criar uma API possuindo duas rotas, uma para obter todos os usuários cadastrados e outra para realizar a sua inserção.

## Endpoints

> Users

GET    - http://localhost/index.php/api/users    - obtêm todos os users

POST   - http://localhost/index.php/api/user     - insere um novo user 

## Arquitetura

Visei utilizar a estrutura Model, View, Controller (MVC) na aplicação. Possuindo na maior parte controllers que recebem as requisições e as validam, que em seguida utilizam de models para realizar comunicações com o banco de dados.

>Estrutura de pastas

- collections - criada no intuito de termos coleções de elementos que herdam de uma classe com métodos para inserir, remvover, atualizar, obter primeiro, último indice e dentre outras funções. Além de termos dentro de determinada collection a garantia que seus elementos fossem de uma respectiva model.  Não implementado por falta de tempo livre. 

- config - dentro de config temos uma função que define as variáveis de ambiente a partir do arquivo .env

- controllers - Controllers para o MVC

- database - temos apenas os controllers do crud, para inserir e ler registros do banco.

- helpers - Alguns métodos que por exemplo podem ser utilizados por diversas classes.

- interfaces - temos interfaces para firmar contratos.

- models - temos models para servir de representação da entity no banco.

- routes - temos uma classe Api.php para definir toda nossa estrutura de rotas

- tests - testes da aplicação

- repositories - Pasta para guardar as classes repositories, seguindo o Repository Pattern, na ideia de manipular os dados do banco.

- services - Pasta para guardar as classes do tipo service, seguindo o Service Pattern, com a intenção de separar o nosso modelo de negócio.


