# <p style="text-align: center;"><img src="https://docs.google.com/uc?id=17bXLP8Me2X66Q4HoIcA_awF0dtKDRbNB" width="350"/></p>

## Introducción
> Prueba de Desafio

## Dependencias BackEnd
``` 
    "require": {
        "php": ">=8.0.2",
        "ext-ctype": "*",
        "ext-iconv": "*",
        "composer/package-versions-deprecated": "1.11.99.4",
        "doctrine/annotations": "^1.0",
        "doctrine/doctrine-bundle": "^2.5",
        "doctrine/doctrine-migrations-bundle": "^3.2",
        "doctrine/orm": "^2.10",
        "phpdocumentor/reflection-docblock": "^5.3",
        "phpstan/phpdoc-parser": "^1.2",
        "sensio/framework-extra-bundle": "^6.1",
        "symfony/apache-pack": "^1.0",
        "symfony/asset": "6.0.*",
        "symfony/console": "6.0.*",
        "symfony/dotenv": "6.0.*",
        "symfony/expression-language": "6.0.*",
        "symfony/flex": "^2",
        "symfony/form": "6.0.*",
        "symfony/framework-bundle": "6.0.*",
        "symfony/http-client": "6.0.*",
        "symfony/intl": "6.0.*",
        "symfony/mailer": "6.0.*",
        "symfony/mime": "6.0.*",
        "symfony/monolog-bundle": "^3.1",
        "symfony/notifier": "6.0.*",
        "symfony/process": "6.0.*",
        "symfony/property-access": "6.0.*",
        "symfony/property-info": "6.0.*",
        "symfony/proxy-manager-bridge": "6.0.*",
        "symfony/rate-limiter": "6.0.*",
        "symfony/runtime": "6.0.*",
        "symfony/security-bundle": "6.0.*",
        "symfony/serializer": "6.0.*",
        "symfony/string": "6.0.*",
        "symfony/translation": "6.0.*",
        "symfony/twig-bundle": "6.0.*",
        "symfony/validator": "6.0.*",
        "symfony/web-link": "6.0.*",
        "symfony/webpack-encore-bundle": "^1.13",
        "symfony/yaml": "6.0.*",
        "twig/extra-bundle": "^2.12|^3.0",
        "twig/twig": "^2.12|^3.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^9.5",
        "symfony/browser-kit": "6.0.*",
        "symfony/css-selector": "6.0.*",
        "symfony/debug-bundle": "6.0.*",
        "symfony/maker-bundle": "^1.0",
        "symfony/phpunit-bridge": "^6.0",
        "symfony/stopwatch": "6.0.*",
        "symfony/web-profiler-bundle": "6.0.*"
    }

```

## Dependencias FrontEnd
``` 
    "devDependencies": {
        "@hotwired/stimulus": "^3.0.0",
        "@popperjs/core": "^2.11.0",
        "@symfony/stimulus-bridge": "^3.0.0",
        "@symfony/webpack-encore": "^1.7.0",
        "bootstrap": "^5.1.3",
        "core-js": "^3.0.0",
        "node-sass": "^7.0.0",
        "regenerator-runtime": "^0.13.2",
        "sass-loader": "^12.4.0",
        "webpack-notifier": "^1.6.0"
    },
       "dependencies": {
        "axios": "^0.24.0",
        "copy-webpack-plugin": "^10.1.0",
        "datatable": "^2.0.2",
        "datatables.net-bs5": "^1.11.3",
        "datatables.net-responsive": "^2.2.9",
        "datatables.net-responsive-bs5": "^2.2.9",
        "material-dashboard": "creativetimofficial/material-dashboard",
        "perfect-scrollbar": "^1.5.3",
        "sweetalert2": "^11.3.0"
    }

```

## Instalación
> **Instalando Dependencias:**
``` 
$ composer install
``` 
``` 
$ yarn install
``` 
> **Construyendo Assets:**
``` 
$ yarn encore dev
``` 
> **Borrando Cache:**
``` 
$ php bin/console cache:clear
``` 
> **Creando Base de Datos:**
``` 
$ php bin/console doctrine:database:create
``` 
> **Agregando Datos de Prueba:**
> Ejecutar el Archivo SQL que se encuentra en ./src/DataFixtures/country.sql
> Ejecutar el Archivo SQL que se encuentra en ./src/DataFixtures/user.sql

> **Datos de Acceso:**
> usuario: admin
> contraseña: a1b2c3$

## Desarrollado Por:
* Ing. Gilberto Carrillo <glavrjk@gmail.com>