
![Logo do projeto](https://github.com/LevyAlves1532/engenharia/blob/master/images/engenharia_logo.png)

## Institucional Engenharia
O projeto institucional engenharia focado na apresentação de uma empresa voltada a engenhari civil. Foi desenvolvido para um cliente, este é um projeto fullstack onde temos o frontend e o backend em um mesmo projeto, utilizei a estrutura MVC no PHP para construir essa aplicação, além disso fiz uma área voltada para os administradores para gerenciar algumas nforamções do site, no site há a possiblidade de comprar projetos de engenharia, para isso é necessário que o usuário faça login na aplicação para finalizar foi feita integração com o mercado pago, para fazer a compra dos projetos.

## Tecnologias

Tecnologias usadas no projeto:

* PHP versão 8.2.12
* Gulp versão 4.0.2
* Sass versão 1.66.1
* Mercado Pago versão 3.0.5
* Node versão 20.9.0 LTS

## Serviços Usados

Integração com banco de dados mysql com a biblioteca PDO do PHP, é necessário para qua a aplicação funcione e integração com o mercado pago para realização de pagamentos pelos projetos comprados.

## Para Iniciar

* Ambiente:
  - Ter o `xampp`, `wamp` ou `mamp` instalados
  - Ter o Node na versão 20.9.0 LTS

* Comandos:
  - Instale as dependencias do projeto na raiz do mesmo com o seguinte comando: `npm install` ou `yarn`
  - Dentro da raiz do projeto e rode o seguinte comando caso queira personalizar os arquivos sass: `npm run gulp`
  - Dentro da pasta `public` é necessario que você rode o comando de `composer install` para instalar as dependencias utilizadas no PHP desse projeto

* Instruções:
  - Logo após rodar o comando dentro da pasta `public`, você tem que configurar o seu projeto, copie e cole o arquivo `.env.exemple` e renomeie ele para `.env` e prencha as informações dele

  *Exemplo*

  ```bash
    HOMOLOG_BASE_URL=http://localhost/projetos/civil_engineer_portfolio/public/
    HOMOLOG_ACCESS_TOKEN_MERCADO_PAGO=
    HOMOLOG_DBNAME=civil_engineer_daniel
    HOMOLOG_HOST=localhost
    HOMOLOG_DBUSER=root
    HOMOLOG_DBPASS=

    BASE_URL=
    ACCESS_TOKEN_MERCADO_PAGO=
    DBNAME=
    HOST=
    DBUSER=
    DBPASS=
  ```

  - Logo após é só acessar na URL colocada em `HOMOLOG_BASE_URL`

## Como usar?

Há integrações no banco de dados, caso você queira testar todas as funcionalidades é necessário que você crie uma conta de teste, colocando um nome, email e senha, podem ser ficticio, e assim você pode testar comprar um projeto para testar, mas é necessário que você integre com uma conta no mercado pago para isso e coloque o `ACCESS_TOKEN_MERCADO_PAGO`, você também pode acessar a painel administrativo com o seguinte email e senha `master@admin.com` e `admin123` e fazer cadastros na área administrativa.

## Preview do Projeto

![Página Home](https://github.com/LevyAlves1532/engenharia/blob/master/images/home.jpeg)
![Página Sobre](https://github.com/LevyAlves1532/engenharia/blob/master/images/about.jpeg)
![Página de Projetos](https://github.com/LevyAlves1532/engenharia/blob/master/images/projects.jpeg)
![Página de Portfolio](https://github.com/LevyAlves1532/engenharia/blob/master/images/portfolio.jpeg)
![Página de Contato](https://github.com/LevyAlves1532/engenharia/blob/master/images/contact.jpeg)
![Dashboard](https://github.com/LevyAlves1532/engenharia/blob/master/images/dashboard.jpeg)

## Funcionalidades do Projeto

Todas as funcionalidades do projeto:
  - Listagem, inserção, edição e exclusão de Projetos
  - Listagem, inserção, edição e exclusão de usuários
  - Listagem, inserção, edição e exclusão do time
  - Gerenciamento dos pagamentos realizados
  - Gerenciamento dos reembolsos do projeto
  - Listagem, inserção, edição e exclusão dos feedbacks
  - Listagem, inserção, edição e exclusão dos posts do instagram
  - Listagem, inserção, edição e exclusão das perguntas frequentes
  - Gerencimento de carrinho dos projetos
  - Checkout transparent com cartão de crédito

## Links

* Repositorio: https://github.com/LevyAlves1532/engenharia_daniel/tree/alternative
  - Caso você encontre algum bug, ou tenha dúvidas sobre o projeto, entre em contato levy.pereiraA1532@gmail.com, desde já agradeço pela atenção!

## Versão do Projeto

1.0.0

## Autor do Projeto

  * **Lêvy Pereira Alves**

Siga o github e junte-se a nós!
Obrigado por me visitar e boa codificação!
