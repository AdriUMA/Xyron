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
*Auto Formatter*
```sh
composer require --dev friendsofphp/php-cs-fixer
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
*Auto Formatter*
```sh
composer run php-cs-fixer
```

## Docs
*Generate [Docs](https://www.phpdoc.org/)*
```sh
./phpDocumentor.phar -d ./src -t ./docs
```