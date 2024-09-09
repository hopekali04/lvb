<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function loadhome() {
        $categories = Category::all()->take(3);

        $topSellingProducts = Product::where('top_selling', true)->take(3)->get();
        
        if ($topSellingProducts->count() < 3) {
            $additionalProducts = Product::where('top_selling', false)
                ->take(3 - $topSellingProducts->count())
                ->get();
            $topSellingProducts = $topSellingProducts->concat($additionalProducts);
        }
        
        return view('landing', compact('categories', 'topSellingProducts'));
    }
    // List all categories
    public function index()
    {
        return Category::all();
    }
    public function fetchAllCategoriesWithProducts()
{
    $categories = DB::table('categories as c')
        ->select(
            'c.category_id',
            'c.category_name',
            'c.description as category_description',
            'c.thumbnail as category_thumbnail',
            'p.product_id',
            'p.product_name',
            'p.price as base_price',
            'p.description as product_description',
            'p.thumbnail as product_thumbnail',
            'pv.variation_name',
            'vo.option_value',
            'pvo.quantity',
            'pvo.price as option_price',
            'i.img_path'
        )
        ->leftJoin('products as p', 'c.category_id', '=', 'p.category_id')
        ->leftJoin('images as i', 'p.product_id', '=', 'i.product_id')
        ->leftJoin('product_variations as pv', 'p.product_id', '=', 'pv.product_id')
        ->leftJoin('variation_options as vo', 'pv.variation_id', '=', 'vo.variation_id')
        ->leftJoin('product_variation_options as pvo', function ($join) {
            $join->on('p.product_id', '=', 'pvo.product_id')
                 ->on('vo.option_id', '=', 'pvo.option_id');
        })
        ->get();

    return $this->processCategoriesWithProducts($categories);
}
    public function fetchProductsByCategoryId($categoryId)
    {
    $products = DB::table('categories as c')
        ->select(
            'c.category_id',
            'c.category_name',
            'c.description as category_description',
            'c.thumbnail as category_thumbnail',
            'p.product_id',
            'p.product_name',
            'p.price as base_price',
            'p.description as product_description',
            'p.thumbnail as product_thumbnail',
            'pv.variation_name',
            'vo.option_value',
            'pvo.quantity',
            'pvo.price as option_price',
            'i.img_path'
        )
        ->leftJoin('products as p', 'c.category_id', '=', 'p.category_id')
        ->leftJoin('images as i', 'p.product_id', '=', 'i.product_id')
        ->leftJoin('product_variations as pv', 'p.product_id', '=', 'pv.product_id')
        ->leftJoin('variation_options as vo', 'pv.variation_id', '=', 'vo.variation_id')
        ->leftJoin('product_variation_options as pvo', function ($join) {
            $join->on('p.product_id', '=', 'pvo.product_id')
                 ->on('vo.option_id', '=', 'pvo.option_id');
        })
        ->where('c.category_id', '=', $categoryId)
        ->get();

        return $this->processSingleCategoriesWithProducts($products);
    }
    private function processSingleCategoriesWithProducts($rawData)
{
    $processedCategories = [];

    foreach ($rawData as $row) {
        $categoryId = $row->category_id;

        // Initialize category if it doesn't exist
        if (!isset($processedCategories[$categoryId])) {
            $processedCategories[$categoryId] = [
                'category_id' => $categoryId,
                'category_name' => $row->category_name,
                'category_description' => $row->category_description,
                'category_thumbnail' => $row->category_thumbnail,
                'products' => []
            ];
        }

        // Process product if it exists
        if ($row->product_id) {
            $productId = $row->product_id;

            // Initialize product if it doesn't exist
            if (!isset($processedCategories[$categoryId]['products'][$productId])) {
                $processedCategories[$categoryId]['products'][$productId] = [
                    'product_id' => $productId,
                    'product_name' => $row->product_name,
                    'base_price' => $row->base_price,
                    'description' => $row->product_description,
                    'product_thumbnail' => $row->product_thumbnail,
                    'variations' => [],
                    'images' => []
                ];
            }

            // Add variation
            $variationKey = $row->variation_name . '_' . $row->option_value;
            if ($row->variation_name && !isset($processedCategories[$categoryId]['products'][$productId]['variations'][$variationKey])) {
                $processedCategories[$categoryId]['products'][$productId]['variations'][$variationKey] = [
                    'variation_name' => $row->variation_name,
                    'option_value' => $row->option_value,
                    'quantity' => $row->quantity,
                    'option_price' => $row->option_price,
                ];
            }

            // Add image if not already added
            if ($row->img_path && !in_array($row->img_path, $processedCategories[$categoryId]['products'][$productId]['images'])) {
                $processedCategories[$categoryId]['products'][$productId]['images'][] = $row->img_path;
            }
        }
    }

    // Convert associative arrays to indexed arrays
    foreach ($processedCategories as &$category) {
        $category['products'] = array_values($category['products']);
        foreach ($category['products'] as &$product) {
            $product['variations'] = array_values($product['variations']);
        }
    }

    // Return the processed categories as an indexed array
    return array_values($processedCategories);
}


private function processCategoriesWithProducts($rawData)
{
    $processedCategories = [];

    foreach ($rawData as $row) {
        $categoryId = $row->category_id;

        // Initialize category if it doesn't exist
        if (!isset($processedCategories[$categoryId])) {
            $processedCategories[$categoryId] = [
                'category_id' => $categoryId,
                'category_name' => $row->category_name,
                'category_description' => $row->category_description,
                'category_thumbnail' => $row->category_thumbnail,
                'products' => []
            ];
        }

        // Process product if it exists
        if ($row->product_id) {
            $productId = $row->product_id;

            // Initialize product if it doesn't exist
            if (!isset($processedCategories[$categoryId]['products'][$productId])) {
                $processedCategories[$categoryId]['products'][$productId] = [
                    'product_id' => $productId,
                    'product_name' => $row->product_name,
                    'base_price' => $row->base_price,
                    'description' => $row->product_description,
                    'product_thumbnail' => $row->product_thumbnail,
                    'variations' => [],
                    'images' => []
                ];
            }

            // Add variation
            $variationKey = $row->variation_name . '_' . $row->option_value;
            if ($row->variation_name && !isset($processedCategories[$categoryId]['products'][$productId]['variations'][$variationKey])) {
                $processedCategories[$categoryId]['products'][$productId]['variations'][$variationKey] = [
                    'variation_name' => $row->variation_name,
                    'option_value' => $row->option_value,
                    'quantity' => $row->quantity,
                    'option_price' => $row->option_price,
                ];
            }

            // Add image
            if ($row->img_path && !in_array($row->img_path, $processedCategories[$categoryId]['products'][$productId]['images'])) {
                $processedCategories[$categoryId]['products'][$productId]['images'][] = $row->img_path;
            }
        }
    }

    // Convert associative arrays to indexed arrays
    foreach ($processedCategories as &$category) {
        $category['products'] = array_values($category['products']);
        foreach ($category['products'] as &$product) {
            $product['variations'] = array_values($product['variations']);
        }
    }

    return array_values($processedCategories);
}

    // Create a new category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        try {
            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailFile = $request->file('thumbnail');
                $thumbnailName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
                $thumbnailPath = 'img/uploads/' . $thumbnailName;
                $thumbnailFile->move(public_path('img/uploads'), $thumbnailName);
            }

            $category = Category::create([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'thumbnail' => $thumbnailPath,
            ]);
            return response()->json(['message' => 'Collection created successfully', 'colletion_id' => $category->id], 201);
        }catch (\Exception $e) {
            Log::error('Collection creation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error creating collection', 'error' => $e->getMessage()], 500);
        }

    }

    // Show a specific category
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return $category;
    }

    // Delete a category
    public function destroy($id)
    {
        Category::destroy($id);
        return response()->noContent();
    }
}
