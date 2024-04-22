# Modelo para Desenvolvimento Web com PHP & GULP

Esse modelo foi criado com intuito de fornecer mais velocidade no carregamento das estilizações e do javascript em especial das estilizações no MVC com PHP.

## Estrutura de Pasta

* `src`: É onde vai ficar todos os arquivos JavaScript e Sass;
* `public`: É a pasta onde faremos o deploy quando formos subir para o servidor;
* `public/assets`: Onde está a compilação do JavaScript e do Sass e LIBs que estão sendo usadas;
* `public/controllers`: Onde se encontra os contraladores das páginas responsaveis por chamar as views e os models caso seja necessário;
* `public/core`: Onde se concentra configurações como das rotas e acesso aos controllers;
* `public/models`: Onde está os arquivos de consumo ao banco de dados;
* `public/views`: Onde se encontra os arquivos visuais de cada página e os templates das mesmas;

## Como usar?

Para usar basta configurar o config.php dentro da pasta `public`, e para rodar o sass e o javascript basta dar um `npm install` e logo após `npm run gulp`.
