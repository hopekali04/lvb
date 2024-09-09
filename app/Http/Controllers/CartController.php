<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Session;

class CartController extends Controller
{
    /*
    public function processCheckout(Request $request)
    {
        $secretKey = env('SECRET_KEY'); // Replace with your actual secret key
        $apiUrl = 'https://api.paychangu.com/payment';
    
        $payload = [
            'amount' => $request->input('amount'),
            'currency' => $request->input('currency', 'MWK'),
            'email' => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'callback_url' => $request->input('callback_url', 'https://webhook.site/9d0b00ba-9a69-44fa-a43d-a82c33c36fdc'),
            'return_url' => $request->input('return_url', 'https://webhook.site'),
            'tx_ref' => '' . mt_rand(1000000000, 9999999999),
            'customization' => [
                'title' => $request->input('title', 'Test Payment'),
                'description' => $request->input('description', 'Payment Description'),
            ],
            'meta' => [
                'uuid' => $request->input('uuid', 'uuid'),
                'response' => $request->input('response', 'Response')
            ]
        ];
    
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $secretKey,
            ])->post($apiUrl, $payload);
    
            // Check if the request was successful (status code 2xx)
            if ($response->successful()) {
                $data = $response->json();
    
                if (isset($data['status']) && $data['status'] === 'success' && isset($data['data']['checkout_url'])) {
                    return redirect()->away($data['data']['checkout_url']);
                } else {
                    // API request was successful, but the response doesn't contain expected data
                    return response()->json([
                        'message' => 'Unexpected response from payment gateway',
                        'response' => $data
                    ], 400);
                }
            } else {
                // API request failed
                return response()->json([
                    'message' => 'Failed to process checkout',
                    'error' => $response->body(),
                    'status_code' => $response->status()
                ], $response->status());
            }
    
        } catch (\Exception $e) {
            // Log the error
            Log::error('Checkout process error: ' . $e->getMessage());
    
            // Return a JSON response with a 500 status code
            return response()->json([
                'message' => 'An error occurred while processing the checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        if (!empty($cart)) {
            $total = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));
        }

        return view('checkout', compact('cart', 'total'));
    }
    public function process(Request $request)
    {
        // dd(session()->all());
        $validatedData = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // TODO: save the order to database
        
        return response()->json([
            'success' => true,
            'message' => 'Order processed successfully',
            'data' => $validatedData
        ]);
    }
    public function addToCart(Request $request)
    {
        // Debug: Log all received data
        \Log::info('Received cart data:', $request->all());

        $product = [
            'id' => $request->product_id,
            'title' => $request->product_title,
            'available_quantity' => $request->available_quantity,
            'size' => $request->size,
            'thumbnail' => $request->product_thumbnail,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'option_id' => $request->option_id,
        ];

        // Debug: Log the product array
        \Log::info('Product array:', $product);

        $cart = Session::get('cart', []);

        // Check if the product is already in the cart
        $productExists = false;
        foreach ($cart as $key => $value) {
            if ($value['id'] == $product['id'] && $value['size'] == $product['size']) {
                $productExists = true;
                $cart[$key]['quantity'] += $product['quantity'];
                break;
            }
        }

        if (!$productExists) {
            $cart[] = $product;
        }

        Session::put('cart', $cart);
        $totalItems = $this->getTotalItems($cart);
        Session::put('totalItems', $totalItems);
        //return "success";

       return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $totalItems = $this->getTotalItems($cart);
        Session::put('totalItems', $totalItems);
        return view('cart', compact('cart', 'totalItems'));
    }
    
    private function getTotalItems($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }
    public function clearCart(Request $request)
{
    $request->session()->forget('cart');
    return redirect()->route('view.cart')->with('success', 'Cart cleared successfully!');
}
}
