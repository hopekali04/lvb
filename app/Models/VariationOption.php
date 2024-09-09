<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariationOption extends Model
{
    protected $fillable = [
        'variation_id',
        'option_value',
    ];

    public function variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }
}