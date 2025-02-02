<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'delivery', 'payment', 'total_price'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

