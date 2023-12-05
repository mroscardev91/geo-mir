<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutOscarController extends Controller
{
    public function index()
    {
        return view('about.oscar');
    }
}
