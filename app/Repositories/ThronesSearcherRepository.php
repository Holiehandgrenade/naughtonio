<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 9/29/17
 * Time: 1:57 PM
 */

namespace App\Repositories;


use Illuminate\Support\Collection;

class ThronesSearcherRepository
{
    /**
     * Returns all characters who have either a spouse or house allegiances and has a name
     *
     * @return Collection
     */
    public function getAllCharacters()
    {
        return collect(json_decode(\Storage::get('public/characters.json')))->filter(function ($n) {
            return ($n->Spouse || $n->Allegiances) && $n->Name;
        });
    }

    public function getAllHouses()
    {
        return collect(json_decode(\Storage::get('public/houses.json')));
    }
}