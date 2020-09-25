<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as PsrClientInterface;
use Psr\Http\Message\ResponseInterface;

final class Client implements ClientInterface
{
    private PsrClientInterface $client;

    public function __construct(PsrClientInterface $client)
    {
        $this->client = $client;
    }

    public function get(string $url): ResponseInterface
    {
        try {
            $request = $this->client->createRequest('GET', $url);
            $response = $this->client->sendRequest($request);

            if ($response->getStatusCode() !== 200) {
                $message = sprintf(
                    'Bad status code: %d',
                    $response->getStatusCode(),
                );

                throw new \DomainException($message);
            }

            return $response;

        } catch (ClientExceptionInterface $exception) {
            throw new \DomainException($exception->getMessage());
        }
    }

    public function getArray(string $url): array
    {
        return json_decode(self::get($url)->getBody()->getContents(), true);
    }
}