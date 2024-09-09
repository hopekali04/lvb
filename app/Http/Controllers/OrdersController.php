<?
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    // List all orders
    public function index()
    {
        return Order::with('user', 'orderItems.productVariationOption')->get();
    }

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
    
            if ($response->successful()) {
                $data = $response->json();
    
                if ($data['status'] === 'success' && isset($data['data']['checkout_url'])) {
                    return redirect()->away($data['data']['checkout_url']);
                }
            }
    
            // If we reach here, something went wrong
            return response()->json([
                'message' => 'Failed to process checkout',
                'error' => $response
            ], 400);
    
        } catch (\Exception $e) {
            // Log the error
            Log::error($e->getMessage());
    
            // Return a JSON response with a 500 status code
            return response()->json([
                'message' => 'An error occurred while processing the checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        $order = Order::create($request->all());

        foreach ($request->order_items as $item) {
            $order->orderItems()->create($item);
        }

        return $order;
    }

    // Show a specific order
    public function show($id)
    {
        return Order::with('user', 'orderItems.productVariationOption')->findOrFail($id);
    }

    // Update an order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return $order;
    }

    // Delete an order
    public function destroy($id)
    {
        Order::destroy($id);
        return response()->noContent();
    }
}
