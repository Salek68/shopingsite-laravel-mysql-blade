<?php

namespace App\Models;

use App\Models\Product;
use App\Models\CategoryZirMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vigei extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vigeiha';

    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(CategoryZirMenu::class, 'category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'vigeiproduct', 'vigei_id', 'product_id')->withPivot('description');
    }
}
