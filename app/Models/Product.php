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
        return $this->belongsToMany(ProductTarget::class, 'product_product_target');
    }
    
    public static function getProductDetail($id)
    {
        return static::with(['arts', 'targets'])->findOrFail($id);
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
