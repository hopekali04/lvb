<?
namespace App\Http\Controllers;

use App\Models\VariationOption;
use Illuminate\Http\Request;

class VariationOptionsController extends Controller
{
    // List all variation options
    public function index()
    {
        return VariationOption::all();
    }

    // Create a new variation option
    public function store(Request $request)
    {
        $request->validate([
            'variation_id' => 'required|exists:product_variations,id',
            'option_value' => 'required|string|max:255',
        ]);

        return VariationOption::create($request->all());
    }

    // Show a specific variation option
    public function show($id)
    {
        return VariationOption::findOrFail($id);
    }

    // Update a variation option
    public function update(Request $request, $id)
    {
        $option = VariationOption::findOrFail($id);
        $option->update($request->all());
        return $option;
    }

    // Delete a variation option
    public function destroy($id)
    {
        VariationOption::destroy($id);
        return response()->noContent();
    }
}
