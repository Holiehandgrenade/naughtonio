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

        if ( ! $characters = \Session::get('thrones.characters')) {
            $characters = $thronesRepo->getAllCharacters();

            // add nicknames to characters who share a name with other characters
            $characters = $characters->sortBy('Name')
                ->map(function ($char) use ($characters) {

                    if (count($characters->where('Name', $char->Name)) > 1) {
                        if($char->Aliases){
                            $nickname = ': ' . collect($char->Aliases)->random();
                        } else {
                            $nickname = '';
                        }
                    } else {
                        $nickname = '';
                    }

                    return [
                        'label' => $char->Name . $nickname,
                        'value' => $char->Id,
                    ];
                })
                ->values();

            // put character array in session for speedy loading
            \Session::put('thrones.characters', $characters);
        }

        return view('public.thronessearcher.show', compact('characters'));
    }

    public function search(Request $request)
    {
        $searcher = new BreadthSearcher($request->input('first_character_id'), $request->input('second_character_id'));

        $path = $searcher->findChain();
        $characterSelectedOne = $searcher->getStartCharacter();
        $characterSelectedTwo = $searcher->getEndCharacter();

        \Session::flash('path', $path);
        \Session::flash('characterSelectedOne', json_encode($characterSelectedOne));
        \Session::flash('characterSelectedTwo', json_encode($characterSelectedTwo));

        return redirect()->route('ice-and-fire-form');
    }
}
