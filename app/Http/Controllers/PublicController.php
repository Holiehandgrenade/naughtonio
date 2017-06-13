<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function barcode()
    {

    }

    public function quoridor()
    {
        return view('public.quoridor.index');
    }
}
