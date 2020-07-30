<?php declare(strict_types=1);

namespace Unit\Application\Checker;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Task\Application\Client\Client;
use Task\Application\Util\RandomGenerateValue;

class ClientTest extends TestCase
{
    /**
     * @dataProvider getUrls
     * @param string $url
     */
    public function testMethodGetWillCallHTTPClient(string $url)
    {
        $response = [
            new MockResponse($body = '{}'),
        ];
        $mockClient = new MockHttpClient($response);
        $client = new Client($mockClient);

        $this->assertInstanceOf(ResponseInterface::class, $client->get($url));
    }

    public function getUrls()
    {
        yield [sprintf('https://lookup.binlist.net/%d', RandomGenerateValue::getBin())];
    }
}