<?php

namespace App\Models;

use App\Models\CategoryZirMenu;
use Illuminate\Database\Eloquent\Model;

class SliderProduct extends Model
{
    protected $table = 'slidersproduct';
    public function zirMenu()
    {
        return $this->belongsTo(CategoryZirMenu::class, 'zir_menu_id');
    }
}
