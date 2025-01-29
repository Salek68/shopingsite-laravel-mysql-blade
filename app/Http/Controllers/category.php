<?php

namespace App\Http\Controllers;

use App\Models\categorymenu;
use Illuminate\Http\Request;

class category extends Controller
{
    function MenuList (Request $req , $pos){
    $category = categorymenu::where('id', '>', 0)->where('active', '=', 1)->where('position', '=', "$pos")->get();
    
    return $category;
    }
}
