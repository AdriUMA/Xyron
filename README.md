# Xyron PHP Framework
## Dependencies
*Composer*
```sh
composer init
```
*Unit Test*
```sh
composer require --dev phpunit/phpunit
```

## Run
*Dev Server*
```sh
php -S localhost:8000
```
*Run Tests*
```sh
composer run tests
```
```sh
composer run tests -- --filter <filter>
```

## Docs
*Generate [Docs](https://www.phpdoc.org/)*
```sh
./phpDocumentor.phar -d ./src -t ./docs
```