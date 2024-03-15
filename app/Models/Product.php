<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function arts()
    {
        return $this->belongsToMany(ProductArt::class, 'product_product_art');
    }
    public function targets()
    {
        return $this->belongsToMany(ProductTarget::class);
    }
    public function productUse()
    {
        return $this->belongsTo(ProductUses::class);
    }
    public function ingredients()
    {
        return $this->belongsToMany(ProductIngredient::class);
    }
    public static function getProductDetail($id)
    {
        return static::with(['arts', 'targets', 'ingredients'])->find($id);
    }
    public function getImageUrl()
    {
        if($this->image)
        {
            if(\Storage::disk('local')->exists("public/product_images/" . $this->image))
            {
                return asset('storage/product_images')."/".$this->image;
            }
        }
        return asset('img/image_not_available.png');
    }

}
