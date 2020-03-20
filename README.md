# Digiboard - Questão 1

Aplicativo para armazenamento de imagens e reconhecimento facial

 > face-api.js, Laravel 7, VueJS, reconhecimento facial

 ## Tabela de conteúdo

 > If you're `README` has a lot of info, section headers might be nice.

 -  [Pré-requisitos](#prerequisites)

 -  [Instalação](#installation)

 -  [Rodar ambiente de desenvolvimento](#running%20the%20tests)

 -  [Rodar ambiente de produção](#running%20the%20tests)

 ---

 ## Prerequisites

 * [NodeJS](https://nodejs.org/en/) >= 12.16.1 - The JavaScript Engineer
 * [NPM](https://www.npmjs.com/) >= 6.14.3 - Node Package Manager
 * [PHP](https://www.php.net/) >= 7.3 - General-purpose scripting language
 * [COMPOSER](https://getcomposer.org/) >= 1.10.1 - A Dependency Manager for PHP 

 ---

 ## Installation

 ```shell
 $ git clone https://github.com/jean-bonilha/digiboard-question1.git
 $ cd digiboard-question1
 $ composer install
 $ cp .env.example .env
 $ php artisan key:generate
 $ cd resources/recognize/app
 $ npm install
 $ npm run build
 ```
 ---

 ## Rodar ambiente de desenvolvimento

 Entre na pasta do projeto SPA dentro da instalação

 ```shell
 $ cd resources/recognize/app
 ```
 
 Faça a instalação das dependências

 ```shell
 $ npm install
 ```
 Depois rode o comando para subir o ambiente de desenvolvimento

 ```shell
 $ npm run serve
 ```

 - Images of what it should look like

 ---

 ## Authors

 * **Jean Bonilha** - *Initial work* - [SpaKIT](https://github.com/spakit/xsd2form)

 ---
