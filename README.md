# PHP Stripe Webhook Tester

[![Latest Version](https://img.shields.io/github/release/teamtnt/php-stripe-webhook-tester.svg?style=flat-square)](https://github.com/teamtnt/php-stripe-webhook-tester/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/teamtnt/php-stripe-webhook-tester/master.svg?style=flat-square)](https://travis-ci.org/teamtnt/php-stripe-webhook-tester)
[![Quality Score](https://img.shields.io/scrutinizer/g/teamtnt/php-stripe-webhook-tester.svg?style=flat-square)](https://scrutinizer-ci.com/g/teamtnt/php-stripe-webhook-tester)
[![Total Downloads](https://img.shields.io/packagist/dt/TeamTNT/php-stripe-webhook-tester.svg?style=flat-square)](https://packagist.org/packages/TeamTNT/php-stripe-webhook-tester)

The goal of this package is to make testing stripe webhooks easy on a local machine without the use
of ngrok or other similar tunneling services. The package will simulate a `post` request to a specified
endpoint with a json containing event data and make sure that your application reacts accordingly.

## Install

Via Composer

``` bash
$ composer require TeamTNT/php-stripe-webhook-tester
```

## Usage

``` php
$tester = new TeamTNT\Stripe\WebhookTester();
$tester->setVersion('2018-05-21');
$tester->setEndpoint('http://local.dev/stripe/webhooks');

$response = $tester->triggerEvent('charge.succeeded');
```

For your convenience you can use chained methods

``` php
$tester = new TeamTNT\Stripe\WebhookTester('http://local.dev/stripe/webhooks');
$response = $tester->setVersion('2014-09-08')->triggerEvent('charge.succeeded');
```
## Laravel Integration 
To implement this package with [Laravel Cashier](http://laravel.com/docs/5.1/billing), you will need to override the `eventExistsOnStripe()` method in `Laravel\Cashier\WebhookController` with something like this:

``` php
protected function eventExistsOnStripe($id)
{
    if(App::environment() == 'testing' or App::environment() == 'local') {
        return true;
    }
    try {
        return ! is_null(StripeEvent::retrieve($id, Config::get('services.stripe.secret')));
    } catch (Exception $e) {
        return false;
    }
}
```
Without the environment checks Cashier attempts to verify that the dummy event is a valid webhook with Stripe, which will obviously fail.

## Available versions and events

Available versions and events can be found in the [webhooks directory](src/webhooks)
## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Nenad Ticaric](https://github.com/nticaric)
- [Sasa Tokic](https://github.com/stokic)
- [Jesse Schutt](https://github.com/jschutt)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
