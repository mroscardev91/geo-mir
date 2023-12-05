<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutAlexController extends Controller
{
    public function index()
    {
        return view('about.alex');
    }
}
