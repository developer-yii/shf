<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIngredient extends Model
{
    use HasFactory;
    protected $table = 'product_ingredients';
    protected $fillable = ['ingredient_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_ingredient');
    }
}
