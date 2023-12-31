<?php declare(strict_types=1);

namespace App\CommissionCalculation\Infrastructure\Parser;

use App\CommissionCalculation\Domain\Commission\Commission;
use App\CommissionCalculation\Domain\Currency\Currency;
use App\CommissionCalculation\Domain\Money\Money;
use App\CommissionCalculation\Infrastructure\Client\ClientInterface;
use App\CommissionCalculation\Domain\Card\Card;

final class Parser implements ParserInterface
{
    public const BIN_URL = 'https://lookup.binlist.net/%s';
    public const EXCHANGE_URL = 'https://api.exchangerate.host/latest';

    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    private function isValid(\stdClass $line): bool
    {
        if ($line->currency && $line->bin && $line->amount) {
            return true;
        }
        return false;
    }

    public function parse(string $json)
    {
        $line = json_decode($json);

        if ( ! $this->isValid($line) ) {
            throw new ParseLineException(sprintf('Bad json line: %s', $json));
        }

        $money = new Money(floatval($line->amount), $this->getCurrencyRate($line->currency));

        $card = $this->getCard($line->bin);

        $commission = new Commission(
            $money,
            $card->isEuro()
        );

        return $commission->calculate();
    }

    private function getCard(string $bin): Card
    {
        $response = $this->client->getArray(sprintf(self::BIN_URL, $bin));

        return new Card($bin, $response['country']['alpha2']);
    }

    private function getCurrencyRate(string $currencyRaw): Currency
    {
        $response = $this->client->getArray(self::EXCHANGE_URL);

        return new Currency($currencyRaw, $response['rates'][$currencyRaw]);
    }
}