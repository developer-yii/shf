<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductArt extends Model
{
    use HasFactory;
    protected $table = 'product_arts';
    protected $fillable = ['name'];
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_art');
    }
}
