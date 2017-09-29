<?php

namespace App\Http\Controllers;

use App\Repositories\ThronesSearcherRepository;
use Illuminate\Http\Request;

class ThronesSearcherController extends Controller
{
    public function show()
    {
        $thronesRepo = new ThronesSearcherRepository();
        $characters = $thronesRepo->getAllCharacters()
            ->mapWithKeys(function ($char) {
                return [$char->Id => $char->Name];
            });
        return view('public.thronessearcher.show', compact('characters'));
    }

    public function search(Request $request)
    {
        dd($request->all());
    }
}
