# SpamScore

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

``SpamScore`` is a simple API client to get an Email's SpamAssassin score and report from a provider. It began a fork of [Riverline\SpamAssassin](https://github.com/rcambien/riverline-spamassassin), but ended up as a rewrite.

## Install

Via Composer

``` bash
$ composer require league/:package_name
```

## Usage

Currently, only the ``Postmark`` provider is implemented.

It uses Postmark's free [Spamcheck webservice](http://spamcheck.postmarkapp.com).


```php
<?php

use SpamScore;

$provider = SpamScore::create('Postmark');
$results = $provider->verify($email);
echo $results->getScore();

// Optionally get the full report
echo $results->getReport();
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

