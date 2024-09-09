<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MedusaService;
use GuzzleHttp\Client;
use App\Http\Controllers\CategoriesController;

class collectionsController extends Controller
{
    protected $medusaService;

    public function __construct(MedusaService $medusaService)
    {
        $this->medusaService = $medusaService;
    }

    public function loadShop()
    {
        $categoriesController = new CategoriesController();
        $data = $categoriesController->fetchAllCategoriesWithProducts();
        return view('shop', ['data' => $data]);
    }
    public function loadCollection($collectionID)
    {
        $categoriesController = new CategoriesController();
        $data = $categoriesController->fetchProductsByCategoryId($collectionID);
        return view('viewCollection', ['data' => $data]);
    }
    
    public function getData()
    {
        $client = new Client([
            'base_uri' => env('MEDUSA_URL'),
            'timeout'  => 2.0,
        ]);
        $method = 'GET'; 
        $url = '/store/collections'; 

        try {
            $response = $client->request($method, $url);
        
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                // Process the response data
               //  echo 'Success! Data:', print_r($data, true);
               return view('lantest', ['data' => $data]);
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
    public function getAll()
    {
        $url = '/admin/collections';
        $method = 'GET';

        $response = $this->medusaService->makeAuthenticatedRequest($method, $url);

        if ($response && $response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            return view('shop', ['data' => $data]);
        } else {
            // echo 'Error:', $response->getStatusCode(), $response->getReasonPhrase();
            return response()->view('404', [], 404);
        }
    }
    public function getByID($id)
    {
        $url = '/admin/collections/' . $id;
        $method = 'GET';

        $response = $this->medusaService->makeAuthenticatedRequest($method, $url);

        if ($response && $response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            return view('viewCollection', ['data' => $data]);
        } else {
            // echo 'Error:', $response->getStatusCode(), $response->getReasonPhrase();
            return response()->view('404', [], 404);
        }
    }

    // Other methods for POST, PUT, DELETE requests can be implemented similarly
}
