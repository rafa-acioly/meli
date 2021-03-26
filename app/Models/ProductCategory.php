<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'id_on_store', 'name', 'meli_name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
