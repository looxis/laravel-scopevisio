# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/looxis/laravel-scopevisio.svg?style=flat-square)](https://packagist.org/packages/looxis/laravel-scopevisio)
[![Build Status](https://img.shields.io/travis/looxis/laravel-scopevisio/master.svg?style=flat-square)](https://travis-ci.org/looxis/laravel-scopevisio)
[![Quality Score](https://img.shields.io/scrutinizer/g/looxis/laravel-scopevisio.svg?style=flat-square)](https://scrutinizer-ci.com/g/looxis/laravel-scopevisio)
[![Total Downloads](https://img.shields.io/packagist/dt/looxis/laravel-scopevisio.svg?style=flat-square)](https://packagist.org/packages/looxis/laravel-scopevisio)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require looxis/laravel-scopevisio
```

## Usage

To register your provider, add it to the array into `config/app.php` file:
```php
'providers' => [
    // Other Service Providers

    Looxis\Laravel\ScopeVisio\ScopeVisioServiceProvider::class,
],
```

Add some properties to your `.env` file (see .env.example)
```php
SCOPEVISIO_CUSTOMER=secret
SCOPEVISIO_USERNAME=your@email.com
SCOPEVISIO_PASSWORD=secret
SCOPEVISIO_ORGANISATION='Some Organisation'
```

For Sandbox Mode add the following properties to your `.env` file (see .env.example)
```php
SCOPEVISIO_SANDBOX=true

SCOPEVISIO_SANDBOX_CUSTOMER=secret
SCOPEVISIO_SANDBOX_USERNAME=your@email.com
SCOPEVISIO_SANDBOX_PASSWORD=secret_password
SCOPEVISIO_SANDBOX_ORGANISATION='Some Organisation'
```

Also you can publish the config file with this artisan command:
``` php
php artisan vendor:publish --provider="Looxis\Laravel\ScopeVisio\ScopeVisioServiceProvider" --tag=config
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dev@looxis.com instead of using the issue tracker.

## Credits

- [Igor Tsapiro](https://github.com/looxis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
