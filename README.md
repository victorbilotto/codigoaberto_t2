# Código Aberto - Temporada 02 

**PROJETO:** Sistema de Chat com Laravel e Vue

Confira no YouTube em [Código Aberto - Temporada 02]

## Getting Started
Essas instruções mostram como ter uma cópia do projeto e executá-lo na sua máquina local para fins de desenvolvimento e teste.

### Prerequisites

O que você precisa para instalar o projeto.

* [PHP](https://www.php.net/) ^7.3
* [MariaDB](https://mariadb.org/)
* [Composer](https://getcomposer.org/)

### Installing

Rode o composer

```sh
composer install
```

Crie o arquivo .env a partir do .env.example

```sh
cp .env.example .env
```

Gere a chave do Laravel

```sh
php artisan key:generate
```

Configure o banco de dados no arquivo .env e rode as migrations

```sh
php artisan migrate
```

Rode o script para gerar os assets

```sh
npm run dev
```

Suba os servidores

```sh
php artisan serve
```
```sh
php artisan websockets:serve
```

## Built with

* [laravel/laravel] (v8.x) - Laravel is a web application framework with expressive, elegant syntax.
* [laravel/sanctum] - Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs.
* [laravel/jetstream] - Laravel Jetstream is a beautifully designed application scaffolding for Laravel.
* [beyondcode/laravel-websockets] - Drop-in Pusher replacement, SSL support, Laravel Echo support and a debug dashboard are just some of its features.
* [tailwindlabs/tailwindcss] - A utility-first CSS framework for rapidly building custom user interfaces.
* [inertiajs/inertia] - Inertia.js lets you quickly build modern single-page React, Vue and Svelte apps using classic server-side routing and controllers.
* [vuejs/vue] - Vue (pronounced /vjuː/, like view) is a progressive framework for building user interfaces.
* [vuejs/vuex] - Centralized State Management for Vue.js.

## Authors
* [Victor Bilotto] - Aplicou o desenvolvimento do projeto

## License
MIT

## Acknowledgments

* [Gustavo Web] - Tutor do treinamento [Código Aberto - Temporada 02] e [UpInside Treinamentos]
* [UpInside Treinamentos] - Site oficial da sua escola de programação e marketing digital

[//]:#
[Victor Bilotto]: <mailto:bilotto.victor@gmail.com>
[Gustavo Web]: <mailto:gustavo@upinside.com.br>
[UpInside Treinamentos]: <https://www.upinside.com.br>
[Código Aberto - Temporada 02]: <https://www.youtube.com/playlist?list=PLBRCgwXk28ixXJEKlWaoUuG38rJAod0AP>
[laravel/laravel]: <https://github.com/laravel/laravel>
[laravel/sanctum]: <https://github.com/laravel/sanctum>
[laravel/jetstream]: <https://github.com/laravel/jetstream>
[beyondcode/laravel-websockets]: <https://github.com/beyondcode/laravel-websockets>
[tailwindlabs/tailwindcss]: <https://github.com/tailwindlabs/tailwindcss>
[inertiajs/inertia]: <https://github.com/inertiajs/inertia>
[vuejs/vue]: <https://github.com/vuejs/vue>
[vuejs/vuex]: <https://github.com/vuejs/vuex>
