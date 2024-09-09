<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\ProductController;

class viewController extends Controller
{
    public function loadViewProd($prodID)
    {
        $prodController = new ProductController();
        try{
            $data = $prodController->fetchOneProduct($prodID);
            return view('viewProduct', ['data' => $data]);
        }
        catch (\Exception $e) {
            return response()->view('404', [], 404);
        }
    }
}