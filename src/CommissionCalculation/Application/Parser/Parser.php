<?php declare(strict_types=1);

namespace App\CommissionCalculation\Application\Parser;

use App\CommissionCalculation\Domain\Commission\{Commission};
use App\CommissionCalculation\Application\Util\CardBinEuroChecker;
use App\CommissionCalculation\Application\Client\ClientInterface;
use App\CommissionCalculation\Domain\Card\Card;
use App\CommissionCalculation\Domain\ExchangeRate\ExchangeRate;

final class Parser implements ParserInterface
{
    public const BIN_URL = 'https://lookup.binlist.net/%s';
    public const EXCHANGE_URL = 'https://api.exchangeratesapi.io/latest';

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

        $rate = $this->getRate($line->currency);
        $isEuro = $this->isEuro($line->bin);

        $commission = new Commission(
            $line->currency,
            $rate,
            floatval($line->amount),
            $isEuro
        );

        return $commission->calculate();
    }

    private function isEuro(string $bin): bool
    {
        $response = $this->client->getArray(sprintf(self::BIN_URL, $bin));

        $card = new Card($response['country']['alpha2']);

        return $card->isEuro();
    }

    private function getRate(string $currency)
    {
        $response = $this->client->getArray(self::EXCHANGE_URL);

        $exchangeRate = new ExchangeRate($currency, $response['rates'][$currency]);

        return $exchangeRate->getRate();
    }
}