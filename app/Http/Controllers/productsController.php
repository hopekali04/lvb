<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\MedusaService;

class productsController extends Controller
{
    protected $medusaService;

    public function __construct(MedusaService $medusaService)
    {
        $this->medusaService = $medusaService;
    }

    public function getAll()
    {
        $client = new Client([
            'base_uri' => env('MEDUSA_URL'),
            'timeout'  => 2.0,
        ]);
        $method = 'GET'; 
        $url = '/store/products'; 

        try {
            $response = $client->request($method, $url);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
               return view('lantest', ['data' => $data]);
            } else {
                echo 'Error:', $response->getStatusCode(), $response->getReasonPhrase();
            }
        } catch (\Exception $e) {
            echo 'Error:', $e->getMessage();
        }
    }
    public function getCategories()
    {
        $client = new Client([
            'base_uri' => env('MEDUSA_URL'),
            'timeout'  => 2.0,
        ]);
        $method = 'GET'; 
        $url = '/admin/collections'; 

        try {
            $response = $client->request($method, $url);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
               return view('lantest', ['data' => $data]);
            } else {
                echo 'Error:', $response->getStatusCode(), $response->getReasonPhrase();
            }
        } catch (\Exception $e) {
            echo 'Error:', $e->getMessage();
        }
    }
    public function getByID($id)
    {
        $client = new Client([
            'base_uri' => env('MEDUSA_URL'),
            'timeout'  => 2.0,
        ]);
        $method = 'GET'; 
        $url = '/store/products/'.$id; 

        try {
            $response = $client->request($method, $url);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                $collectionID = $data['product']['collection_id'];
                
                $url = '/admin/collections/' . $collectionID;
                $method = 'GET';

                $colResponse = $this->medusaService->makeAuthenticatedRequest($method, $url);

                if ($colResponse->getStatusCode() === 200) {
                    $colData = json_decode($colResponse->getBody(), true);
                    return view('viewProduct', ['data' => $data, 'collections' => $colData]);
                } else {
                    echo 'Error:', $colResponse->getStatusCode(), $colResponse->getReasonPhrase();
                }
            } else {
                echo 'Error:', $response->getStatusCode(), $response->getReasonPhrase();
            }
        } catch (\Exception $e) {
            return response()->view('404', [], 404);
        }
    }

}
