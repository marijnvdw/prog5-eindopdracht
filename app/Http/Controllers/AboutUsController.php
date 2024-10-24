<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    public function show(): View
    {
        return view('about-us');
    }
}
