<?php

namespace App\Services;

use GuzzleHttp\Client;

class NumverifyService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('NUMVERIFY_API_KEY');
    }

    public function verifyPhoneNumber($phoneNumber)
    {
        $url = 'http://apilayer.net/api/validate?access_key=' . $this->apiKey . '&number=' . urlencode($phoneNumber);

        try {
            $response = $this->client->get($url);
            $data = json_decode($response->getBody()->getContents(), true);

            return [
                'valid' => $data['valid'],
                'number' => $data['number'],
                'local_format' => $data['local_format'],
                'international_format' => $data['international_format'],
                'country_prefix' => $data['country_prefix'],
                'country_code' => $data['country_code'],
                'country_name' => $data['country_name'],
                'location' => $data['location'],
                'carrier' => $data['carrier'],
                'line_type' => $data['line_type'],
            ];
        } catch (\Exception $e) {
            return [
                'valid' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
