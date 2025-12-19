<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\MessageHistory;

class WassengerService {
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct() {
        $this->client = new Client(['verify' => false]);
        $this->baseUrl = config('wassenger.base_url');
        $this->apiKey = config('wassenger.api_key');
    }

    public function sendMessages($messages) {
        foreach ($messages as $item) {
            try {
                $response = $this->client->post('https://api.wassenger.com/v1/messages', [
                    'headers' => [
                        'Authorization' => "Bearer {$this->apiKey}",
                        'Content-Type' => 'application/json',
                    ],
                    'json' => !empty($message->media) ? [
                        'phone' => substr($item->phone_number, 0, 4) !== '+225' ? '+225' . $item->phone_number : $item->phone_number,
                        "media" => config('app.url') . $item->media,
                        'caption' => $item->message,
                    ] : [
                        'phone' => substr($item->phone_number, 0, 4) !== '+225' ? '+225' . $item->phone_number : $item->phone_number,
                        'message' => $item->message,
                    ],
                ]);

                $statusCode = $response->getStatusCode();
                $data = json_decode($response->getBody()->getContents(), true);

                if ($statusCode == 201) {
                    $item->update([
                        'status' => 'delivered',
                        'response' => json_encode($data)
                    ]);
                } else {
                    $item->update([
                        'status' => 'failed',
                        'response' => json_encode($data)
                    ]);
                }
            } catch (\Exception $e) {
                $item->update([
                    'status' => 'failed',
                    'response' => $e->getMessage(),
                ]);
            }
        }
    }

    public function sendMessage($message) {
        try {
            $response = $this->client->post('https://api.wassenger.com/v1/messages', [
                'headers' => [
                    'Authorization' => "Bearer {$this->apiKey}",
                    'Content-Type' => 'application/json',
                ],
                'json' => !empty($message->media) ? [
                    'phone' => substr($message->phone_number, 0, 4) !== '+225' ? '+225' . $message->phone_number : $message->phone_number,
                    "media" => config('app.url') . $message->media,
                    'caption' => $message->message,
                ] : [
                    'phone' => substr($message->phone_number, 0, 4) !== '+225' ? '+225' . $message->phone_number : $message->phone_number,
                    'message' => $message->message,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $data = json_decode($response->getBody()->getContents(), true);

            if ($statusCode == 201) {
                $message->update([
                    'status' => 'delivered',
                    'response' => json_encode($data)
                ]);
            } else {
                $message->update([
                    'status' => 'failed',
                    'response' => json_encode($data)
                ]);
            }
        } catch (\Exception $e) {
            $message->update([
                'status' => 'failed',
                'response' => $e->getMessage(),
            ]);
        }
    }
}
