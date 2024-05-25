<?php
// In app/Services/OcrService.php
namespace App\Services;

use GuzzleHttp\Client;

class OcrService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('ADVANCE_AI_SECRET_KEY');
    }

    public function performOcr($documentImage)
    {
        $response = $this->client->post('https://api.advance.ai/ocr/v1/perform', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => [
                'image' => $documentImage,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
