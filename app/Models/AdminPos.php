<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminPos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'adminpos';

    public function positions()
    {
        return $this->belongsTo(Positions::class, 'pos_id', 'id');  // استفاده از pos_id به جای id برای ارتباط
    }
}
