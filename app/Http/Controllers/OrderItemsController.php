<?

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_variation_option_id' => 'required|exists:product_variation_options,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderItem = OrderItem::create($request->all());

        return response()->json($orderItem, 201);
    }

    public function index()
    {
        $orderItems = OrderItem::with(['order', 'productVariationOption'])->get();
        return response()->json($orderItems);
    }

    public function show($id)
    {
        $orderItem = OrderItem::with(['order', 'productVariationOption'])->find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }
        return response()->json($orderItem);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_variation_option_id' => 'required|exists:product_variation_options,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }

        $orderItem->update($request->all());
        return response()->json($orderItem);
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }

        $orderItem->delete();
        return response()->json(['message' => 'Order Item deleted']);
    }

}
