<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function barcode()
    {
        return view('public.barcode.index');
    }

    public function barcodeize()
    {
        dd('asdf');
    }

    public function quoridor()
    {
        return view('public.quoridor.index');
    }

    public function tinyTables()
    {
        return view('public.tiny-tables.index');
    }

    public function pathfinder()
    {
        return view('public.pathfinder.index');
    }

    public function geneticPathfinder()
    {
        return view('public.genetic-pathfinder.index');
    }

    public function starWars()
    {
        return view('public.star-wars.index');
    }

    public function clock()
    {
        return view('public.clock.index');
    }

    public function face()
    {
        return view('public.face.index');
    }

    public function loans()
    {
        return view('public.loans.index');
    }

    public function jp()
    {
        return view('public.jp.index');
    }

    public function jpPost(Request $request)
    {
        $word = $request->input('input');
        $chars = str_split($word);
        $digits = [];
        foreach ($chars as $char) {
            array_push($digits, ord($char));
        }

        $full = [];
        for($i = 0; $i < 30; $i++) {
            array_push($full, ($i+1) * ($digits[($i%count($digits))]));
        }

        $p="/[!@#$%^&*();|+=._a-zA-Z0-9]/";
        $final = [];
        foreach ($full as $index => $val) {
            $counter = 2;

            if($index < 2){
                $val = $val*3;
            }

            while( ! preg_match($p, chr($val))) {
                $val = floor($val / $counter);
                $counter++;
                if($val < 10){
                    $val += ($counter*$counter);
                }
            }
            array_push($final, chr($val));
        }

        $output = implode("", $final);
        return view('public.jp.return', compact('output'));
    }
}
