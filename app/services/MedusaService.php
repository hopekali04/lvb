<?php
// app/Services/MedusaService.php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class MedusaService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('MEDUSA_URL'),
            'timeout' => 2.0,
        ]);
    }

    public function getMedusaToken()
    {
        try {
            $tokenResponse = Http::post(env('MEDUSA_URL') . '/admin/auth/token', [
                'email' => 'admin@medusa-test.com',
                'password' => 'admin'
            ]);

            if (!$tokenResponse->successful()) {
                return null;
            }

            return $tokenResponse->json('access_token');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function makeAuthenticatedRequest($method, $url)
    {
        $token = $this->getMedusaToken();

        if (!$token) {
            return null; // Or handle the error appropriately
        }

        try {
            $response = $this->client->request($method, $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            return $response;
        } catch (\Exception $e) {
            return null; // Or handle the error appropriately
        }
    }
}
