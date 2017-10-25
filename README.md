# Dandomain Pay PHP SDK

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A library for using the Dandomain Pay API to make payments in the Dandomain webshop system

## Install

Via Composer

```bash
$ composer require loevgaard/dandomain-pay-php-sdk
```

## Usage
### Create Payment from ServerRequestInterface
```php
<?php
use Loevgaard\Dandomain\Pay\Model\Payment;

/**
* The $request need to implement the PSR7 ServerRequestInterface
 * 
 * @var \Psr\Http\Message\ServerRequestInterface $request
 */
$payment = Payment::createFromRequest($request);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email `joachim@loevgaard.dk` instead of using the issue tracker.

## Credits

- [Joachim Løvgaard][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/loevgaard/dandomain-pay-php-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/loevgaard/dandomain-pay-php-sdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/loevgaard/dandomain-pay-php-sdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/loevgaard/dandomain-pay-php-sdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/loevgaard/dandomain-pay-php-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/loevgaard/dandomain-pay-php-sdk
[link-travis]: https://travis-ci.org/loevgaard/dandomain-pay-php-sdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/loevgaard/dandomain-pay-php-sdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/loevgaard/dandomain-pay-php-sdk
[link-downloads]: https://packagist.org/packages/loevgaard/dandomain-pay-php-sdk
[link-author]: https://github.com/loevgaard
[link-contributors]: ../../contributors
