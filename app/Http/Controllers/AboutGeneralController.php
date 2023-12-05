<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutGeneralController extends Controller
{
    public function index()
    {
        return view('about.about');
    }
}
