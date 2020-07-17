<?php declare(strict_types=1);

namespace Task\Client;

use Symfony\Component\HttpClient\HttpClient;

class ClientFactory
{
    public static function create(): Client
    {
        return new Client(HttpClient::create());
    }
}