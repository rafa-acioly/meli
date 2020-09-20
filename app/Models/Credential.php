<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = ['service_name', 'consumer_key', 'consumer_secret'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
