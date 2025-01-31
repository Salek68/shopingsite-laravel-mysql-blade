<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model
{
    protected $table = 'comment_product';
    protected $fillable = ['product_id', 'comment', 'verify', 'like', 'dislike'];
}
