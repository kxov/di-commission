<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Client;

use Symfony\Component\HttpClient\HttpClient;

class ClientFactory
{
    public static function create(): Client
    {
        return new Client(HttpClient::create());
    }
}