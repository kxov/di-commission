<?php declare(strict_types=1);

namespace App\CommissionCalculation\Domain\Transaction;

use App\CommissionCalculation\Domain\Card\Card;
use App\CommissionCalculation\Domain\Money\Money;

final class Transaction
{
    private Card  $card;
    private Money $amount;

    public function __construct(Card $card, Money $amount)
    {
        $this->card = $card;
        $this->amount = $amount;
    }
}