<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Positions extends Model
{
      use HasFactory, SoftDeletes;
    protected $table = 'positions';
    public function adminPos()
    {
        return $this->hasMany(AdminPos::class, 'pos_id', 'id');
    }

}
