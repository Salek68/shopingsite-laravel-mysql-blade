<?php

namespace App\Models;

use App\Models\CategoryZirMenu;
use Illuminate\Database\Eloquent\Model;

class BanerCategory extends Model
{
    public function category()
    {
        return $this->belongsTo(CategoryZirMenu::class, 'productid');
    }

}
