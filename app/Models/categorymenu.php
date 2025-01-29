<?php

namespace App\Models;

use App\Models\CategoryZirMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class categorymenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category_menu';

    public function submenus()
    {
        return $this->hasMany(CategoryZirMenu::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
