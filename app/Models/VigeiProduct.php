<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VigeiProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vigeiproduct';

    protected $fillable = ['product_id', 'vigei_id', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function vigei()
    {
        return $this->belongsTo(Vigei::class, 'vigei_id');
    }
}
