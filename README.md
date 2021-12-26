# The Message

## Table of Contents

* [Package and Version](#package-and-version)
* [Installation](#installation)

## Package and Version

|PHP|Laravel|Inertia js|Vue|tailwindcss
|:-:|:-:|:-:|:-:|:-:|
|^7.3|^8.65|^0.4.3|^3.0.5|^2.1.2

## Installation

``` bash
# clone the repo
$ git clone https://github.com/msisaif/the-message.git

# go into app's directory
$ cd the-message

# install app's dependencies
$ composer install

# Copy file ".env.example", and change its name to ".env".

# Linux
$ cp .env.example .env

# windows
$ copy .env.example .env
```

Then in file ".env" setup database configuration:
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=the_message
* DB_USERNAME=root
* DB_PASSWORD=

### Next step

``` bash
# generate laravel APP_KEY
$ php artisan key:generate

# run database migration
$ php artisan migrate

# run database seed
$ php artisan db:seed

# install app's dependencies
$ npm install

# and repeat generate mixing
$ npm run dev

# start server
$ php artisan serve
```
