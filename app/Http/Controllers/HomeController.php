<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // aqui estan los controladores para las diferentes paginas del sitio
    public function index(){
        return view('index');
    }
}
