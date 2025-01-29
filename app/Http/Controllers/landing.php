<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class landing extends Controller
{
    function index(){
        
        return view('landing');
    }
}
