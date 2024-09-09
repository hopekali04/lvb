<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class paymentController extends Controller
{
    public function checkout(Request $request)
    {

        try {
            // Validate the request
            $validatedData = $request->validate([
                'email' => 'required|email',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'cart' => 'required|array',
                'cart.*.option_id' => 'required|exists:variation_options,option_id',
                'cart.*.quantity' => 'required|integer|min:1',
                'cart.*.price' => 'required|numeric|min:0',
                'amount' => 'required|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors()
            ], 422);
        }


        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'email' => $validatedData['email'],
                'order_date' => now(),
                'total_amount' => $validatedData['amount'], // Changed from 'total_amount' to 'amount'
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($validatedData['cart'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id, // Added this line to link OrderItem to the Order
                    'variation_option_id' => $item['option_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();
            
            // Process payment
            $paymentResponse = $this->processPayment($order, $validatedData);

            if ($paymentResponse->successful()) {
                $data = $paymentResponse->json();

                if (isset($data['status']) && $data['status'] === 'success' && isset($data['data']['checkout_url'])) {
                    // Update order status
                    $order->update(['status' => 'processing']);
                    $order->update(['checkout_url' => $data['data']['checkout_url']]);

                    return redirect()->away($data['data']['checkout_url']);
                    //return redirect()->away('http://127.0.0.1:8000/cart');
                } else {
                    throw new \Exception('Unexpected response from payment gateway');
                }
            } else {
                throw new \Exception('Failed to process payment API LEVEL');
            }
                

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout process error: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while processing the checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    private function processPayment(Order $order, array $validatedData)
    {
        $secretKey = env('SECRET_KEY'); // Replace with your actual secret key
        $apiUrl = 'https://api.paychangu.com/payment';

        $payload = [
            'amount' => $order->total_amount,
            'currency' => 'MWK',
            'email' => $validatedData['email'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'callback_url' => 'http://localhost:8000/handle-payment?',
            'return_url' => 'http://localhost:8000/handle-payment?',
            'tx_ref' => $order->id . '-' . uniqid(),
            'customization' => [
                'title' => 'Order #' . $order->id,
                'description' => 'Payment for Order #' . $order->id,
            ],
            'meta' => [
                'order_id' => $order->id,
            ]
        ];

        return Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $secretKey,
        ])->post($apiUrl, $payload);
    }

    public function handlePaymentCallback(Request $request)
    {
        // Verify the payment status and update the order accordingly
        $paymentData = $request->all();
        Log::info('Payment callback received', $paymentData);

        // Extract the order ID from tx_ref
        $orderIdParts = explode('-', $paymentData['tx_ref']);
        $orderId = $orderIdParts[0];

        $order = Order::findOrFail($orderId);

        if ($paymentData['status'] === 'successful') {
            $order->update(['status' => 'paid']);
            // Trigger any post-payment actions (e.g., send confirmation email, update inventory)
        } elseif ($paymentData['status'] === 'failed') {
            $order->update(['status' => 'payment_failed']);
        }

        return response()->json(['message' => 'Callback processed successfully']);
    }

    public function handlePaymentReturn(Request $request)
    {
        // Get the tx_ref from the query parameters
        $tx_ref = $request->query('tx_ref');

        // Extract the order ID from the tx_ref
        $orderIdParts = explode('-', $tx_ref);
        $orderId = $orderIdParts[0];

        $order = Order::findOrFail($orderId);

        // Verify the payment using the verify transaction endpoint
        $secretKey = env('SECRET_KEY'); // Replace with your secret key
        $verifyUrl = "https://api.paychangu.com/verify-payment/$tx_ref";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $secretKey,
        ])->get($verifyUrl);

        $responseData = json_decode($response->body(), true);

        if ($responseData['status'] === 'success') {
            // Update the order status to successful
            $order->status = 'successful';
            $order->save();

            // TODO: Update records and reduce invetory count then record sale

            return redirect()->route('order.confirmation', ['order' => $order->id]);
        } else {
            // Update the order status to failed
            $order->status = 'failed';
            $order->save();

            // todo: use an error page and Log response too
            // Update the order status to failed
            $order->status = 'failed';
            $order->save();

            return redirect()->route('order.failed', ['order' => $order->id]);
        
        }
    }
    public function orderConfirmation(Order $order)
    {
        return view('order-confirmation', compact('order'));
    }
    public function failed(Order $order)
    {
        return view('failed-order', compact('order'));
    }
}
