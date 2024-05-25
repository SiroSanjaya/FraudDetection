<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZeroBounceService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.zerobounce.api_key');
    }

    public function verifyEmail($email)
    {
        $response = $this->client->get('https://api.zerobounce.net/v2/validate', [
            'query' => [
                'api_key' => $this->apiKey,
                'email' => $email,
                'ip_address' => ''
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
