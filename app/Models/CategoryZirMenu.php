<?php

namespace App\Models;

use App\Models\BanerCategory;
use Illuminate\Database\Eloquent\Model;

class CategoryZirMenu extends Model
{

    protected $table = 'category_zir_menu';
    protected $primaryKey = 'id';
    public function categoryMenu()
    {
        return $this->belongsTo(CategoryMenu::class, 'category_id');
    }
    // public function sliderproduct()
    // {
    //     return $this->hasMany(CategoryZirMenu::class, 'zir_menu_id');
    // }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function categorybaner()
    {
        return $this->hasMany(BanerCategory::class, 'category_id');
    }
}
