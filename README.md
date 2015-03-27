# PHP Stripe Webhook Tester

[![Latest Version](https://img.shields.io/github/release/teamtnt/php-stripe-webhook-tester.svg?style=flat-square)](https://github.com/teamtnt/php-stripe-webhook-tester/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/teamtnt/php-stripe-webhook-tester/master.svg?style=flat-square)](https://travis-ci.org/teamtnt/php-stripe-webhook-tester)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/teamtnt/php-stripe-webhook-tester.svg?style=flat-square)](https://scrutinizer-ci.com/g/teamtnt/php-stripe-webhook-tester/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/teamtnt/php-stripe-webhook-tester.svg?style=flat-square)](https://scrutinizer-ci.com/g/teamtnt/php-stripe-webhook-tester)
[![Total Downloads](https://img.shields.io/packagist/dt/TeamTNT/php-stripe-webhook-tester.svg?style=flat-square)](https://packagist.org/packages/TeamTNT/php-stripe-webhook-tester)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require TeamTNT/php-stripe-webhook-tester
```

## Usage

``` php
$tester = new TeamTNT\Stripe\WebhookTester();
$tester->setVersion('2014-09-08');
$tester->setEndpoint('http://local.dev/stripe/webhooks');

$response = $tester->triggerEvent('charge.succeeded');
```

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Nenad Ticaric](https://github.com/nticaric)
- [Sasa Tokic](https://github.com/stokic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
