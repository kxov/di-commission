<?php declare(strict_types=1);

namespace Task\Client;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface ClientInterface
{
    public function get(string $url): ResponseInterface;
}