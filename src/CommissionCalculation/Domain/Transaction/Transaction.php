<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Transaction;

use App\CommissionCalculation\Domain\Card\Card;
use App\CommissionCalculation\Domain\Currency\Currency;

final class Transaction
{
    private Card $card;
    private Currency $currency;
    private float $amount;

    public function __construct(Card $card, Currency $currency, float $amount)
    {
        $this->card = $card;
        $this->currency = $currency;
        $this->amount = $amount;
    }
}