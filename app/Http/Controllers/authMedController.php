<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class authMedController extends Controller
{
    public function getMedusaCollections()
    {
        try {
            // Replace API_URL with the actual endpoint URL
            $tokenResponse = Http::post(env('MEDUSA_URL') . '/admin/auth/token', [
                'email' => 'admin@medusa-test.com', // Replace with your credentials
                'password' => 'admin' // Replace with your credentials
            ]);

            if (!$tokenResponse->successful()) {
                return response()->json([
                    'error' => 'Failed to obtain authentication token',
                    'response' => $tokenResponse->json() // Include error details
                ], 401); // Unauthorized
            }

            $token = $tokenResponse->json('access_token'); // Assuming response contains access_token
            echo 'Data:', print_r($token, true);

            // Make a request to the "localhost:9000/admin/collections" URL with the token in the Authorization header
            $collectionsResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get(env('MEDUSA_URL') .'/admin/collections');

            if ($collectionsResponse->successful()) {
                // Assuming you want to return the collections data
                $data = json_decode($collectionsResponse->getBody(), true);
                return view('collectionsTest', ['data' => $data]);
                // return response()->json($collectionsResponse->json(), 200);
            } else {
                // Handle unsuccessful response
                return response()->json([
                    'error' => 'Failed to fetch collections',
                    'response' => $collectionsResponse->json() // Include error details
                ], 500);
            }

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error fetching data:', ['error' => $e->getMessage()]);
            return response()->json([
                'something Happpened' => $e
            ], 500);
        }
    }

    public function getMedusaProducts()
    {
        try {
            $tokenResponse = Http::post(env('MEDUSA_URL') . '/admin/auth/token', [
                'email' => 'admin@medusa-test.com', // Replace with your credentials
                'password' => 'admin' // Replace with your credentials
            ]);

            if (!$tokenResponse->successful()) {
                return response()->json([
                    'error' => 'Failed to obtain authentication token',
                    'response' => $tokenResponse->json() // Include error details
                ], 401); // Unauthorized
            }

            $token = $tokenResponse->json('access_token'); // Assuming response contains access_token
            echo 'Data:', print_r($token, true);

            // Make a request to the "localhost:9000/admin/collections" URL with the token in the Authorization header
            $collectionsResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get(env('MEDUSA_URL') .'/admin/products');

            if ($collectionsResponse->successful()) {
                // Assuming you want to return the collections data
                $data = json_decode($collectionsResponse->getBody(), true);
                return view('productsTest', ['data' => $data]);
                // return response()->json($collectionsResponse->json(), 200);
            } else {
                // Handle unsuccessful response
                return response()->json([
                    'error' => 'Failed to fetch collections',
                    'response' => $collectionsResponse->json() // Include error details
                ], 500);
            }

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error fetching data:', ['error' => $e->getMessage()]);
            return response()->json([
                'something Happpened' => $e
            ], 500);
        }
    }
    public function getMedusaToken()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => env('MEDUSA_URL'),
            // You can set any number of default request options
            'timeout'  => 2.0,
        ]);
        $method = 'GET'; // Change to 'POST', 'PUT', 'DELETE', etc. as needed
        $url = '/store/products'; // Replace with the desired Medusa.js API endpoint

        try {
            $tokenResponse = Http::post(env('MEDUSA_URL') . '/admin/auth/token', [
                'email' => 'admin@medusa-test.com', 
                'password' => 'admin' 
            ]);

            if (!$tokenResponse->successful()) {
                return response()->json([
                    'error' => 'Failed to obtain authentication token',
                    'response' => $tokenResponse->json() // Include error details
                ], 401); // Unauthorized
            }

            $token = $tokenResponse->json('access_token'); // Assuming response contains access_token
            //echo 'Data:', print_r($token, true);

            $response = $client->request($method, $url);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                // Process the response data
               echo 'Success:';
            } else {
                echo 'Error:', $response->getStatusCode(), $response->getReasonPhrase();
            }
        } catch (\Exception $e) {
            echo 'Error:', $e->getMessage();
        }
        /*

        try {
            $response = $client->request('GET', '/api/data');
            $data = json_decode($response->getBody(), true);
            // Process $data as needed
            return $data;
        } catch (\Exception $e) {
            // Handle exceptions
            return $e->getMessage();
        } */
    }

    public function fetchProductsAndCollections()
    {
        $token = $this->getMedusaToken();

        if (!$token) {
            return response()->json(['error' => 'Failed to get token'], 500);
        }

        try {
            // Fetch products
            $responseProducts = $this->client->get('/admin/products', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $products = json_decode($responseProducts->getBody(), true);

            // Fetch collections
            $responseCollections = $this->client->get('/admin/collections', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $collections = json_decode($responseCollections->getBody(), true);

            return response()->json([
                'products' => $products,
                'collections' => $collections,
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }
}
