<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['id_on_store', 'name', 'meli_name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
