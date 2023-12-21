<?php

declare(strict_types=1);

namespace GoogleSearchApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Psr\Log\LoggerInterface;

class GoogleSearchClient
{
    private Client $httpClient;
    private LoggerInterface $logger;

    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->httpClient = $client;
        $this->logger = $logger;
    }

    public function search(string $query): array
    {
        try {
            if ($query === '') {
                throw new SearchException('Query cannot be empty');
            }

            $this->httpClient->request('GET', 'https://google.com/search?q=' . $query);
        } catch (TransferException $exception) {
            $this->logger->error(
                'Error while searching for {query}: {message}',
                [
                    'query' => $query,
                    'message' => $exception->getMessage(),
                ]
            );
        }

        $this->logger->debug('Searching for {query}', ['query' => $query]);

        return [];
    }
}
