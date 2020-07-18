<?php declare(strict_types=1);

namespace Task\Parser;

use Task\Commission\Commission;
use Task\Util\Checker;
use Task\Client\ClientInterface;

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

        $code = $response['country']['alpha2'];

        return Checker::check($code);
    }

    private function getRate(string $currency)
    {
        $response = $this->client->getArray(self::EXCHANGE_URL);

        return $response['rates'][$currency] ?? 0;
    }
}