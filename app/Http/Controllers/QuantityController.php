<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class QuantityController extends Controller
{
    // Count total inventory for a single product
    public function countProductInventory($productId)
    {
        return DB::table('product_variation_options')
            ->where('product_id', $productId)
            ->sum('quantity');
    }

    // Count all product inventory
    public function countAllProductInventory()
    {
        return DB::table('product_variation_options')
            ->sum('quantity');
    }

    // Add product quantity
    public function addProductQuantity($productId, $optionId, $quantity)
    {
        return DB::table('product_variation_options')
            ->where('product_id', $productId)
            ->where('option_id', $optionId)
            ->increment('quantity', $quantity);
    }

    // Reduce product quantity
    public function reduceProductQuantity($productId, $optionId, $quantity)
    {
        return DB::table('product_variation_options')
            ->where('product_id', $productId)
            ->where('option_id', $optionId)
            ->decrement('quantity', $quantity);
    }

    // Get current quantity for a specific product variation option
    public function getCurrentQuantity($productId, $optionId)
    {
        return DB::table('product_variation_options')
            ->where('product_id', $productId)
            ->where('option_id', $optionId)
            ->value('quantity');
    }

    // Update product quantity (can be used for both adding and reducing)
    public function updateProductQuantity($productId, $optionId, $newQuantity)
    {
        return DB::table('product_variation_options')
            ->where('product_id', $productId)
            ->where('option_id', $optionId)
            ->update(['quantity' => $newQuantity]);
    }
}