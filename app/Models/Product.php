<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['buying_mode', 'woo_product_sku', 'meli_product_sku'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
