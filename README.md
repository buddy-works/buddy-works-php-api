# Buddy Works APIs PHP SDK
[![Build Status](https://travis-ci.org/buddy-works/buddy-works-php-api.svg?branch=master)](https://travis-ci.org/buddy-works/buddy-works-php-api)
Buddy's officially supported PHP client library.

## Installation

This library is distributed on `packagist` and is working with `composer`. In order to add it as a dependency, run the following command:

``` sh
composer require buddy-works/buddy-works-php-api
```

> **Note:** This version of the Buddy SDK for PHP requires PHP 5.5 or greater.
 
## Usage of OAUTH

In progress...

## Usage of direct tokens

In progress...

## Apis

For detailed info check [our documentation](https://buddy.works/api/reference/getting-started/overview)
 
In progress...

## Tests

Add 2 direct tokens in your Buddy profile:
 - one with all scopes
 - second only with USER INFO scope
Add application & get client id, client secret
Copy file tests/env.php.dist -> tests/env.php and fill up variables
Run command:
``` sh
./vendor/bin/phpunit --coverage-text --exclude-group integration
```

## License

Please see the [license file](https://github.com/buddy-works/buddy-works-php-api/blob/master/LICENSE) for more information.