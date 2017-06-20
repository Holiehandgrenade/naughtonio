<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipController extends Controller
{
    public function show()
    {
        return view('zip.show');
    }

    public function post(Request $request)
    {

    }
}
