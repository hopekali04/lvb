<?
namespace App\Http\Controllers;

use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationsController extends Controller
{
    // List all product variations
    public function index()
    {
        return ProductVariation::all();
    }

    // Create a new product variation
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_name' => 'required|string|max:255',
        ]);

        return ProductVariation::create($request->all());
    }

    // Show a specific product variation
    public function show($id)
    {
        return ProductVariation::with('options')->findOrFail($id);
    }

    // Update a product variation
    public function update(Request $request, $id)
    {
        $variation = ProductVariation::findOrFail($id);
        $variation->update($request->all());
        return $variation;
    }

    // Delete a product variation
    public function destroy($id)
    {
        ProductVariation::destroy($id);
        return response()->noContent();
    }
}
