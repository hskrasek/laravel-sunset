<?php

namespace HSkrasek\Laravel\Sunset\Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class SunsetsEndpointsTest extends TestCase
{
    /**
     * @test
     */
    public function itSunsetsANormalResponseObject()
    {
        $response = (new StubController)->response();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertNotEmpty($sunset = $response->headers->get('Sunset'));
        $this->assertTrue(Carbon::parse(StubController::SUNSET_DATE)->equalTo(Carbon::parse($sunset)));
    }

    /**
     * @test
     */
    public function itSunsetsAJsonResponseObject()
    {
        $response = (new StubController)->jsonResponse();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertNotEmpty($sunset = $response->headers->get('Sunset'));
        $this->assertTrue(Carbon::parse(StubController::SUNSET_DATE)->equalTo(Carbon::parse($sunset)));
    }

    /**
     * @test
     */
    public function itSunsetsARedirectResponseObject()
    {
        $response = (new StubController)->response();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertNotEmpty($sunset = $response->headers->get('Sunset'));
        $this->assertTrue(Carbon::parse(StubController::SUNSET_DATE)->equalTo(Carbon::parse($sunset)));
    }

    /**
     * @test
     */
    public function itSunsetsANormalResponseObjectWithALink()
    {
        $response = (new StubController)->response('http://example.com');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertNotEmpty($sunset = $response->headers->get('Sunset'));
        $this->assertTrue(Carbon::parse(StubController::SUNSET_DATE)->equalTo(Carbon::parse($sunset)));
        $this->assertTrue($response->headers->has('Link'));
        $this->assertSame('<http://example.com>; rel="sunset"', $response->headers->get('Link'));
    }

    /**
     * @test
     */
    public function itSunsetsANormalResponseObjectThatAlreadyHasALinkWithALink()
    {
        $response = (new StubController)->linkResponse('http://example.com');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertNotEmpty($sunset = $response->headers->get('Sunset'));
        $this->assertTrue(Carbon::parse(StubController::SUNSET_DATE)->equalTo(Carbon::parse($sunset)));
        $this->assertTrue($response->headers->has('Link'));
        $this->assertTrue(in_array(
            '<http://example.com>; rel="sunset"',
            $response->headers->get('Link', null, false),
            true
        ));
    }
}
