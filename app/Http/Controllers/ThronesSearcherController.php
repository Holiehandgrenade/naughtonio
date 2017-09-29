<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThronesSearcherController extends Controller
{
    public function show()
    {
        return view('public.thronessearcher.show');
    }
}
