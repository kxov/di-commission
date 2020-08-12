<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class Client implements ClientInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $url): ResponseInterface
    {
        try {
            $response = $this->client->request('GET', $url);

            if ($response->getStatusCode() !== 200) {
                $message = sprintf(
                    'Bad status code: %d',
                    $response->getStatusCode(),
                );

                throw new \DomainException($message);
            }

            return $response;

        } catch (TransportExceptionInterface $exception) {
            throw new \DomainException($exception->getMessage());
        }
    }

    public function getArray(string $url): array
    {
        return self::get($url)->toArray();
    }
}