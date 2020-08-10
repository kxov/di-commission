<?php declare(strict_types=1);

namespace App\CommissionCalculation\Application\Client;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface ClientInterface
{
    public function get(string $url): ResponseInterface;
}