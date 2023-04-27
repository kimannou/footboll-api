<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FootApiConnector
{
    private $client;
    private $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function sendRequest(string $method, string $path, array $query = []): array
    {
        $headers = [
            'X-RapidAPI-Key' => $this->apiKey,
            'Accept' => 'application/json'
        ];

        $response = $this->client->request($method, $_ENV['FOOT_API_URL'] . $path, [
            'headers' => $headers,
            'query' => $query,
        ]);

        return $response->toArray();
    }
}