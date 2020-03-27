# Digiboard - Questão 1

Aplicativo para armazenamento de imagens e reconhecimento facial

 > face-api.js, Laravel 7, VueJS, reconhecimento facial

 ## Tabela de conteúdo

 -  [Pré-requisitos](#prerequisites)

 -  [Instalação](#installation)

 -  [Rodar ambiente de desenvolvimento](#running%20the%20tests)

 ---

 ## Prerequisites

 * [NodeJS](https://nodejs.org/en/) >= 12.16.1 - The JavaScript Engineer
 * [NPM](https://www.npmjs.com/) >= 6.14.3 - Node Package Manager
 * [PHP](https://www.php.net/) >= 7.3 - General-purpose scripting language
 * [Composer](https://getcomposer.org/) >= 1.10.1 - A Dependency Manager for PHP 

 ---

 ## Installation

 ```shell
 $ git clone https://github.com/jean-bonilha/digiboard-question1.git
 $ cd digiboard-question1
 $ composer install
 $ cp .env.example .env
 $ php artisan key:generate
 $ php artisan migrate
 $ cd resources/recognize/app
 $ npm install
 $ npm run build
 ```
 ---

 ## Rodar ambiente de desenvolvimento

 Rodar Migrations junto com as Seeders

 ```shell
 $ php artisan migrate --seed
 $ cd resources/recognize/app
 $ npm install
 $ npm run serve
 ```
 ---

 ## Authors

 * **Jean Bonilha**

 ---
