<?php

namespace App\Services;

use GuzzleHttp\Client;

class Gurunavi
{
    private const RESTAURANTS_SEARCH_API_URL = 'https://api.gnavi.co.jp/RestSearchAPI/v3/';

    public function searchRestaurants(string $word): array
    {
        $client = new Client();
        $response = $client
            ->get(self::RESTAURANTS_SEARCH_API_URL, [
                'query' => [
                    'keyid' => env('GURUNAVI_ACCESS_KEY'),
                    'freeword' => str_replace(' ', ',', $word),
                ],
                'http_errors' => false,
            ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
