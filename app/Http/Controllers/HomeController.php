<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function prod()
    {
        $categories = Category::all();
        return view('admin/products', compact('categories'));
    }
    public function orders()
    {
        $orders = Order::all(); // Fetch all orders from the database
        return view('admin/orders', compact('orders'));
    }
    public function confirmOrder(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $order = DB::selectOne('SELECT * FROM orders WHERE id = ?', [$id]);
            
            if (!$order) {
                abort(404);
            }

            // Update the order status to 'Confirmed'
            DB::update('UPDATE orders SET status = ? WHERE id = ?', ['Confirmed', $id]);

            // Fetch order items
            $orderItems = DB::select('SELECT * FROM order_items WHERE order_id = ?', [$id]);

            foreach ($orderItems as $item) {
                // Get the current quantity for the product variation option
                $currentQuantity = DB::selectOne('
                    SELECT quantity 
                    FROM product_variation_options 
                    WHERE option_id = ?', 
                    [$item->variation_option_id]
                );

                if (!$currentQuantity) {
                    throw new \Exception("Product variation option not found");
                }

                $newQuantity = $currentQuantity->quantity - $item->quantity;

                if ($newQuantity < 0) {
                    throw new \Exception("Insufficient inventory for product variation option ID: " . $item->variation_option_id);
                }

                // Update the quantity
                DB::update('
                    UPDATE product_variation_options 
                    SET quantity = ? 
                    WHERE option_id = ?', 
                    [$newQuantity, $item->variation_option_id]
                );
            }

            DB::commit();
            return redirect()->route('view.order', $id)->with('success', 'Order has been confirmed successfully and inventory updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('view.order', $id)->with('error', 'Error confirming order: ' . $e->getMessage());
        }
    }
    public function viewOrder($id)
    {
        $order = DB::selectOne('SELECT * FROM orders WHERE id = ?', [$id]);
        
        if (!$order) {
            abort(404);
        }

        $orderItems = DB::select('
            SELECT oi.*, vo.option_value, pv.variation_name, p.product_name, p.price AS product_price
            FROM order_items oi
            JOIN variation_options vo ON oi.variation_option_id = vo.option_id
            JOIN product_variations pv ON vo.variation_id = pv.variation_id
            JOIN products p ON pv.product_id = p.product_id
            WHERE oi.order_id = ?
        ', [$id]);

        return view('admin/view_order', compact('order', 'orderItems'));
        // return view('admin/view_order', compact('order'));
    }
    public function cat()
    {
        return view('admin/categories');
    }
    public function customers()
    {
        return view('admin/customers');
    }
    public function getMedusaCollections()
    {
        try {
            $tokenResponse = Http::post(env('MEDUSA_URL') . '/admin/auth/token', [
                'email' => 'admin@medusa-test.com', // Replace with your credentials
                'password' => 'admin' // Replace with your credentials
            ]);

            if (!$tokenResponse->successful()) {
                return response()->json([
                    'error' => 'Failed to obtain authentication token',
                    'response' => $tokenResponse->json("error", "Failed to authenticate, check with administrator")
                    // TODO: Create an error response page for better UX
                ], 401); // Unauthorized
            }

            $token = $tokenResponse->json('access_token'); 
            //echo 'Data:', print_r($token, true);

            $collectionsResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->get(env('MEDUSA_URL') .'/admin/collections');

            if ($collectionsResponse->successful()) {
                $data = json_decode($collectionsResponse->getBody(), true);
                // Assuming you want to return the collections data
                return view('collectionsTest', ['collections' => $data]);
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
}
