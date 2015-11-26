# 9jamoji
[![License](http://img.shields.io/:license-mit-blue.svg)](https://github.com/andela-sakande/PotatoORM/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/andela-sakande/potatoORM.svg)](https://travis-ci.org/andela-sakande/potatoORM)
A RestFul API using S​lim​ for Emoji​Service. This API is built with Eloquent ORM and JWT for
token based authentication.

DIRECTORY STRUCTURE
-------------------

```
app/           core package code
   |base     controllers and models
   |routes   samples class to test the model class
   |views    custom exception classes
tests/       tests of the routes used
public/       public directory to access the api
```

## Installation

[PHP](https://php.net) 5.3+ and [Composer](https://getcomposer.org) are required.

Via Composer

``` bash
$ composer require sirolad/9jamoji
```
or
``` composer.json
"require": {
        "sirolad/9jamoji": "dev-master"
    }
```

## Usage

The documentation of this API is found at [the official website](https://9jamoji.herokuapp.com). Please refer to it for more information.



## Change log

Please check out [CHANGELOG](CHANGELOG.md) file for information on what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit test
```

``` composer
$ composer test
```

## Contributing

Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.

## Credits

9jamoji is developed and maintained by `Surajudeen Akande`.

## License

9jamoji is released under the MIT Licence. See the bundled [LICENSE](LICENSE.md) file for details.

## Supported Databases

``` bash
All databases supported by Eloquent ORM.
```
