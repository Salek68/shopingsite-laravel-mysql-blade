<?php

namespace App\Models;

use App\Models\slider;
use App\Models\categorymenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productsA';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'final_price',
        'sku',
        'category_id',
        'brand_id',
        'stock',
        'sold',
        'image',
        'status',
        'is_featured',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'status' => 'string',
    ];

    /**
     * Relations
     */

    // ارتباط با دسته‌بندی
    public function category()
{
    return $this->belongsTo(CategoryZirMenu::class, 'category_id', 'id');
}
public function vigeis()
{
    return $this->belongsToMany(Vigei::class, 'vigeiproduct', 'product_id', 'vigei_id');

}

    public function slider()
    {
        return $this->hasMany(slider::class, 'productid');
    }
    // ارتباط با برند
    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }

    // ارتباط با تصاویر اضافی
    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }

    // // ارتباط با ویژگی‌های محصول
    // public function attributes()
    // {
    //     return $this->hasMany(ProductAttribute::class);
    // }

    /**
     * Calculate the final price after applying the discount
     */
    // public function getFinalPriceAttribute($discount,$price)
    // {
    //     if ($discount > 0) {
    //         return $price - ($price * ($discount / 100));
    //     }
    //     return $price;
    // }
}
