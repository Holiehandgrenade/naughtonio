<?php

namespace App\Http\Controllers;

use App\Repositories\ThronesSearcherRepository;
use Illuminate\Http\Request;

class ThronesSearcherController extends Controller
{
    public function show()
    {
        $thronesRepo = new ThronesSearcherRepository();
        $characters = $thronesRepo->getAllCharacters();
        dd($characters);

        return view('public.thronessearcher.show');
    }
}
