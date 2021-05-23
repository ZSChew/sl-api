<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $dateFormat = 'U';
    protected $fillable = [
        "key",
        "value",
        "updated_at",
        "created_at"
    ];
}
