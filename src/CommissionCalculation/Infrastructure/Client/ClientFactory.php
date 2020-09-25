<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Client;

use Symfony\Component\HttpClient\Psr18Client;

class ClientFactory
{
    public static function create(): ClientInterface
    {
        return new Client(new Psr18Client());
    }
}