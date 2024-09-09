<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\ProductVariation;
use App\Models\VariationOption;
use App\Models\Images;
use App\Models\ProductVariationOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        return Product::all();
    }
    public function createProductWithImg(Request $request)
{
    $validator = Validator::make($request->all(), [
        'category_id' => 'required|exists:categories,category_id',
        'product_name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'thumbnail' => 'required|image', // 2MB Max
        'product_images.*' => 'image', // 2MB Max
        'sizes.*' => 'required|string|distinct',
        'variations' => 'required|array|min:1',
        'variations.*.size' => 'required|string',
        'variations.*.quantity' => 'required|integer|min:0',
        'variations.*.price' => 'nullable|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    DB::beginTransaction();

    try {
        // Handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = 'img/uploads/' . $thumbnailName;
            $thumbnailFile->move(public_path('img/uploads'), $thumbnailName);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'thumbnail' => $thumbnailPath,
        ]);

        // Handle product images upload
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'img/uploads/' . $imageName;
                $image->move(public_path('img/uploads'), $imageName);
                Images::create([
                    'product_id' => $product->id,
                    'img_path' => $imagePath,
                ]);
            }
        }

        // Create size variation
        $sizeVariation = ProductVariation::create([
            'product_id' => $product->id,
            'variation_name' => 'Size',
        ]);

        // Create size options and variations
        $sizes = array_unique($request->input('variations.*.size'));
        foreach ($sizes as $index => $size) {
            $sizeOption = VariationOption::create([
                'variation_id' => $sizeVariation->id,
                'option_value' => $size,
            ]);
            
            $variation = $request->input("variations.{$size}");
            ProductVariationOption::create([
                'product_id' => $product->id,
                'option_id' => $sizeOption->id,
                'quantity' => $variation['quantity'],
                'price' => $variation['price'] ?? $product->price,
            ]);
        }

        DB::commit();

        return response()->json(['message' => 'Product created successfully', 'product_id' => $product->id], 201);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error creating product', 'error' => $e->getMessage()], 500);
    }
}

    public function createProduct(Request $request)
{
    //return response()->json(['message' => 'Successful']);
    Log::info('Received product creation request', $request->all());

    $validator = Validator::make($request->all(), [
        'category_id' => 'required|exists:categories,id',
        'product_name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'colors' => 'required|array|min:1',
        'colors.*' => 'required|string|distinct',
        'sizes' => 'required|array|min:1',
        'sizes.*' => 'required|string|distinct',
        'variations' => 'required|array|min:1',
        'variations.*.color' => 'required|string|in:' . implode(',', $request->colors),
        'variations.*.size' => 'required|string|in:' . implode(',', $request->sizes),
        'variations.*.quantity' => 'required|integer|min:0',
        'variations.*.price' => 'nullable|numeric|min:0',
    ]);

    if ($validator->fails()) {
        Log::warning('Validation failed', ['errors' => $validator->errors()]);
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $validatedData = $validator->validated();

    DB::beginTransaction();

    try {
        // Create the product
        $product = Product::create([
            'category_id' => $validatedData['category_id'],
            'product_name' => $validatedData['product_name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
        ]);
        Log::info('Product created', ['product' => $product]);

        // Create color variation
        $colorVariation = ProductVariation::create([
            'product_id' => $product->id,
            'variation_name' => 'Color',
        ]);
        Log::info('Color variation created', ['variation' => $colorVariation]);

        // Create size variation
        $sizeVariation = ProductVariation::create([
            'product_id' => $product->id,
            'variation_name' => 'Size',
        ]);
        Log::info('Size variation created', ['variation' => $sizeVariation]);

        // Create color options
        $colorOptions = [];
        foreach ($validatedData['colors'] as $color) {
            $colorOptions[] = VariationOption::create([
                'variation_id' => $colorVariation->id,
                'option_value' => $color,
            ]);
        }
        Log::info('Color options created', ['options' => $colorOptions]);

        // Create size options
        $sizeOptions = [];
        foreach ($validatedData['sizes'] as $size) {
            $sizeOptions[] = VariationOption::create([
                'variation_id' => $sizeVariation->id,
                'option_value' => $size,
            ]);
        }
        Log::info('Size options created', ['options' => $sizeOptions]);

        // Create product variation options
        foreach ($validatedData['variations'] as $variation) {
            $colorOption = collect($colorOptions)->firstWhere('option_value', $variation['color']);
            $sizeOption = collect($sizeOptions)->firstWhere('option_value', $variation['size']);

            ProductVariationOption::create([
                'product_id' => $product->id,
                'option_id' => $sizeOption->id,
                'quantity' => $variation['quantity'],
                'price' => $variation['price'] ?? $product->price,
            ]);

            ProductVariationOption::create([
                'product_id' => $product->id,
                'option_id' => $colorOption->id,
                'quantity' => $variation['quantity'],
                'price' => $variation['price'] ?? $product->price,
            ]);
        }
        Log::info('Product variation options created');

        DB::commit();

        return response()->json(['message' => 'Product created successfully', 'product_id' => $product->id], 201);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Product creation failed', [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'message' => 'Error creating product',
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
}

    // Create a new product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        return Product::create($request->all());
    }

    // Show a specific product
    public function show($id)
    {
        return Product::with('variations.options')->findOrFail($id);
    }
    // more detailed return of the product with details
    public function fetchOneProduct($productId)
{
    $result = DB::table('products as p')
        ->select(
            'p.product_id',
            'p.product_name',
            'p.price as base_price',
            'p.description',
            'p.thumbnail as product_thumbnail',
            'c.category_name',
            'pv.variation_name',
            'vo.option_id',
            'vo.option_value',
            'pvo.quantity',
            'pvo.price as option_price',
            'i.img_path'
        )
        ->join('categories as c', 'p.category_id', '=', 'c.category_id')
        ->leftJoin('images as i', 'p.product_id', '=', 'i.product_id')
        ->join('product_variations as pv', 'p.product_id', '=', 'pv.product_id')
        ->join('variation_options as vo', 'pv.variation_id', '=', 'vo.variation_id')
        ->join('product_variation_options as pvo', function ($join) {
            $join->on('p.product_id', '=', 'pvo.product_id')
                 ->on('vo.option_id', '=', 'pvo.option_id');
        })
        ->where('p.product_id', $productId)
        ->get();

    // Process the result to group variations and images
    $processedResult = $this->processProductResult($result);

    return $processedResult;
}

private function processProductResult($result)
{
    $processedProduct = null;
    $variations = [];
    $images = [];

    foreach ($result as $row) {
        if (!$processedProduct) {
            $processedProduct = [
                'product_id' => $row->product_id,
                'product_name' => $row->product_name,
                'base_price' => $row->base_price,
                'description' => $row->description,
                'product_thumbnail' => $row->product_thumbnail,
                'category_name' => $row->category_name,
            ];
        }

        // Add variation
        $variationKey = $row->variation_name . '_' . $row->option_value;
        if (!isset($variations[$variationKey])) {
            $variations[$variationKey] = [
                'option_id' => $row->option_id,
                'variation_name' => $row->variation_name,
                'option_value' => $row->option_value,
                'quantity' => $row->quantity,
                'option_price' => $row->option_price,
            ];
        }

        // Add image to array if it's not already there
        if ($row->img_path && !in_array($row->img_path, $images)) {
            $images[] = $row->img_path;
        }
    }

    $processedProduct['variations'] = array_values($variations);
    $processedProduct['images'] = $images;

    return $processedProduct;
}
public function getProduct($productId)
{
    $product = DB::table('products as p')
        ->join('product_variations as pv', 'p.id', '=', 'pv.product_id')
        ->join('variation_options as vo', 'pv.id', '=', 'vo.variation_id')
        ->join('product_variation_options as pvo', function($join) {
            $join->on('p.id', '=', 'pvo.product_id')
                 ->on('vo.id', '=', 'pvo.option_id');
        })
        ->select('p.product_name','p.description','p.price', 'pv.variation_name', 'vo.option_value', 'pvo.quantity', 'pvo.price')
        ->where('p.id', $productId)
        ->get();

    $variations = [
        'colour' => [],
        'size' => [],
    ];
    foreach ($product as $item) {
        if (strtolower($item->variation_name) == 'color') {
            $variations['colour'][] = [
                'option_value' => $item->option_value,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        } elseif (strtolower($item->variation_name) == 'size') {
            $variations['size'][] = [
                'option_value' => $item->option_value,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        }
    }
    $formattedProduct = [
        'product_name' => $product->isEmpty() ? null : $product[0]->product_name,
        'description' => $product->isEmpty() ? null : $product[0]->description,
        'price' => $product->isEmpty() ? null : $product[0]->price,
        'variations' => $variations,
    ];

    return $formattedProduct;
}

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return $product;
    }

    // Delete a product
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->noContent();
    }
}
