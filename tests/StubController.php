<?php namespace HSkrasek\Laravel\Sunset\Tests;

use HSkrasek\Laravel\Sunset\SunsetsEndpoints;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class StubController
{
    const SUNSET_DATE = '2017-11-09 12:00:00';

    use SunsetsEndpoints;

    public function response($link = null)
    {
        return $this->sunsetResponse(
            Response::create(),
            self::SUNSET_DATE,
            $link
        );
    }

    public function jsonResponse()
    {
        return $this->sunsetResponse(
            JsonResponse::create(),
            self::SUNSET_DATE
        );
    }

    public function redirectResponse()
    {
        return $this->sunsetResponse(
            RedirectResponse::create(),
            self::SUNSET_DATE
        );
    }

    public function linkResponse($link)
    {
        return $this->sunsetResponse(
            Response::create('', 200, ['Link' => '<testing.foo>; rel="testing"']),
            self::SUNSET_DATE,
            $link
        );
    }
}
