<?php namespace HSkrasek\Laravel\Sunset;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

trait SunsetsEndpoints
{
    /**
     * Add's the Sunset and optional Link headers to a response, marking the
     * endpoint for deprecation.
     *
     * @param Response $response
     * @param \Carbon\Carbon|\DateTime|string $date
     * @param null|string $link
     *
     * @return Response
     */
    public function sunsetResponse(Response $response, $date, ?string $link = null): Response
    {
        return tap($response, function (Response $response) use ($date, $link) {
            $response->headers->set('Sunset', $this->normalizeDate($date));

            if (null !== $link) {
                $response->headers->set('Link', sprintf('<%s>; rel="sunset"', $link), false);
            }
        });
    }

    /**
     * @param \Carbon\Carbon|\DateTime|string $date
     *
     * @return string
     */
    private function normalizeDate($date): string
    {
        if (is_string($date)) {
            return Carbon::parse($date)->format(Carbon::RFC7231);
        }

        if ($date instanceof \DateTime) {
            return Carbon::instance($date)->format(Carbon::RFC7231);
        }

        return $date->format(Carbon::RFC7231);
    }
}
