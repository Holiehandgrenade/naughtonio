<?php

namespace App\Http\Controllers;

use App\Libraries\BreadthSearcher;
use App\Repositories\ThronesSearcherRepository;
use Illuminate\Http\Request;

class ThronesSearcherController extends Controller
{
    public function show()
    {
        $thronesRepo = new ThronesSearcherRepository();
        $characters = $thronesRepo->getAllCharacters()
            ->map(function ($char) {
                return [
                    'label' => $char->Name,
                    'value' => $char->Id,
                ];
            })
            ->values();
        return view('public.thronessearcher.show', compact('characters'));
    }

    public function search(Request $request)
    {
        $searcher = new BreadthSearcher($request->input('first_character_id'), $request->input('second_character_id'));

        $path = $searcher->findChain();
        $characterSelectedOne = $searcher->getStartCharacter()->Name;
        $characterSelectedTwo = $searcher->getEndCharacter()->Name;

        \Session::flash('path', $path);
        \Session::flash('characterSelectedOne', $characterSelectedOne);
        \Session::flash('characterSelectedTwo', $characterSelectedTwo);

        return redirect()->route('ice-and-fire-form');
    }
}
