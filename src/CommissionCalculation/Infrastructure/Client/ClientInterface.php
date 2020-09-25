<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Client;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function get(string $url): ResponseInterface;
}