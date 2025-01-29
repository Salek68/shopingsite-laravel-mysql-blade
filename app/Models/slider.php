<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class slider extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sliders';

    public function product()
    {
        return $this->belongsTo(Product::class, 'productid');
    }

}
