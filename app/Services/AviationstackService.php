<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AviationstackService
{
    protected $apiKey;
    protected $baseUrl = 'http://api.aviationstack.com/v1/';

    public function __construct()
    {
        // Config + ENV Fallback for API Key
        $this->apiKey = config('services.aviationstack.key') ?? env('AVIATIONSTACK_KEY');
    }

    /**
     * Flights Search Method
     */
    public function searchFlights($depIata = null, $arrIata = null)
    {
        if (!$this->apiKey) {
            return [
                'success' => false,
                'message' => 'API key is missing in .env file (AVIATIONSTACK_KEY).',
                'data'    => [],
            ];
        }

        $params = [
            'access_key' => $this->apiKey,
            'limit'      => 10,
        ];

        if ($depIata) {
            $params['dep_iata'] = strtoupper(trim($depIata)); // e.g. DXB
        }

        if ($arrIata) {
            $params['arr_iata'] = strtoupper(trim($arrIata)); // e.g. LHR
        }

        try {
            // Aviationstack Free Tier ONLY supports http:// (not https)
            $response = Http::get("{$this->baseUrl}flights", $params);

            if ($response->failed() || isset($response->json()['error'])) {
                return [
                    'success' => false,
                    'message' => $response->json()['error']['info'] ?? 'Failed to fetch live flight data.',
                    'data'    => [],
                ];
            }

            return [
                'success' => true,
                'data'    => $response->json()['data'] ?? [],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Connection Error: ' . $e->getMessage(),
                'data'    => [],
            ];
        }
    }
}