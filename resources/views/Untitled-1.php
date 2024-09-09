<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MedusaController extends Controller
{
    public function getData()
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
            $response = $client->request($method, $url);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                // Process the response data
               //  echo 'Success! Data:', print_r($data, true);
               return view('tess', ['data' => $data]);
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

    // Other methods for POST, PUT, DELETE requests can be implemented similarly
}
