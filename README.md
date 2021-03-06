# CRUD Model Actions

[![Packagist PHP support](https://img.shields.io/packagist/php-v/sfneal/crud-model-actions)](https://packagist.org/packages/sfneal/crud-model-actions)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/crud-model-actions.svg?style=flat-square)](https://packagist.org/packages/sfneal/crud-model-actions)
[![Build Status](https://travis-ci.com/sfneal/crud-model-actions.svg?branch=master&style=flat-square)](https://travis-ci.com/sfneal/crud-model-actions)
[![Quality Score](https://img.shields.io/scrutinizer/g/sfneal/crud-model-actions.svg?style=flat-square)](https://scrutinizer-ci.com/g/sfneal/crud-model-actions)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/crud-model-actions.svg?style=flat-square)](https://packagist.org/packages/sfneal/crud-model-actions)

Abstraction layers for creating CRUD Action classes to execute actions on Eloquent Models.

## Installation

You can install the package via composer:

```bash
composer require sfneal/crud-model-actions
```

## Usage

Use Action classes extended from CrudModelAction to execute CRUD actions on Eloquent Models.

In order to set a default TrackingEvent to be fired upon successful execution, publish the ServiceProvider & specify an Event.
 
``` php
php artisan vendor:publish --provider="Sfneal\CrudModelActions\Providers\CrudModelActionServiceProvider"
```

``` php
// Usage description here
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

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
