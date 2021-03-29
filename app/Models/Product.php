<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id_on_store', 'user_id', 'buying_mode', 'sku', 'meli_sku', 'name', 'price', 'image_url'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
