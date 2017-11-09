# Laravel Sunset

[![Build Status][travis-image]][travis-url]
[![MIT License][license-image]][license-url]

Laravel Sunset allows you to deprecate URLs (API or otherwise).

The [Sunset header][sunset-draft] is an in-development HTTP response header that is aiming to standardize how URLs are marked for deprecation. tl:dr; it looks a bit like this:

```
Sunset: Sat, 31 Dec 2018 23:59:59 GMT
```

This can be combined with a `Link: <http://foo.com/something> rel="sunset"` which can be anything that might help a developer know what is going on. Maybe link to your API documentation for the new resource, the OpenAPI/JSON Schema definitions, or even a blog post explaining the change.

[sunset-draft]: https://tools.ietf.org/html/draft-wilde-sunset-header-03

## Install

Via Composer

```bash
composer require hskrasek/laravel-sunset
```

## Usage

Within your base controller, add the following:

```php
<?php

namespace App\Http\Controllers;

use HSkrasek\Laravel\Sunset\SunsetsEndpoints;

class Controller {
    use SunsetsEndpoints;
}
```

Then when returning a response from your controller, do the following:

```php
<?php

namespace App\Http\Controllers;

use HSkrasek\Laravel\Sunset\SunsetsEndpoints;

class APIController extends Controller {
    public function index()
    {
        // Other logic here
        return $this->sunsetsResponse(
            response()->json(['foo' => 'bar',]),
            '2017-12-31 23:59:59', // When this endpoint is being deprecated
            'http://example.com' // Optional link explaining the deprecation
        );
    }
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Bug reports and pull requests are welcome on GitHub at [hskrasek/laravel-sunset](https://github.com/hskrasek/laravel-sunset). This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

[travis-url]: https://travis-ci.org/hskrasek/laravel-sunset
[travis-image]: https://travis-ci.org/hskrasek/laravel-sunset.svg?branch=master

[license-url]: LICENSE
[license-image]: http://img.shields.io/badge/license-MIT-000000.svg?style=flat-square
