<?php

declare(strict_types=1);

namespace GoogleSearchApi\Tests;

use GoogleSearchApi\GoogleSearchClient;
use GoogleSearchApi\SearchException;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class GoogleSearchClientTest extends TestCase
{
    public function testSuccessfulSearch(): void
    {
        $guzzleClientMock = $this->createMock(Client::class);
        $loggerMock = $this->createMock(LoggerInterface::class);

        $client = new GoogleSearchClient($guzzleClientMock, $loggerMock);

        $result = $client->search('php');

        $this->assertIsArray($result);
    }

    public function testEmptySearch(): void
    {
        $guzzleClientMock = $this->createMock(Client::class);
        $loggerMock = $this->createMock(LoggerInterface::class);

        $client = new GoogleSearchClient($guzzleClientMock, $loggerMock);

        $this->expectException(SearchException::class);
        $client->search('');
    }
}
