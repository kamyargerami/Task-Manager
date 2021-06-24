<p align="center"><a href="https://kamyar.dev" target="_blank"><img src="./public/images/logo.png" width="400"></a></p>

## Simple Task Management System

One page task manager using Laravel. You can manage your tasks in projects easily also it supports drag and drop.

## Installation

You need to run these commands one by one to install the project requirements

```
composer install

npm install

cp .env.example .env

```

Setup your database information in .env file and then migrate the database

```
php artisan migrate
```

You can import default data to see how the system normally works

```
php artisan db:seed
```
