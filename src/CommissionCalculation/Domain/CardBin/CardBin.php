<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\CardBin;

final class CardBin
{
    private string $alpha2;

    public function __construct(string $alpha2)
    {
        $this->alpha2 = $alpha2;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }
}