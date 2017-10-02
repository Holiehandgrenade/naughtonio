<?php

namespace App\Http\Controllers;

use App\Libraries\BreadthSearcher;
use App\Repositories\ThronesSearcherRepository;
use Illuminate\Http\Request;

class ThronesSearcherController extends Controller
{
    public function show()
    {
        session()->forget('path');

        $thronesRepo = new ThronesSearcherRepository();
        $characters = $thronesRepo->getAllCharacters()
            ->mapWithKeys(function ($char) {
                return [$char->Id => $char->Name];
            });
        return view('public.thronessearcher.show', compact('characters'));
    }

    public function search(Request $request)
    {
        $searcher = new BreadthSearcher();

        $path = $searcher->findChain($request->input('first_character'), $request->input('second_character'));

        \Session::flash('path', $path);

        return back()->with('path', $path);
    }
}
