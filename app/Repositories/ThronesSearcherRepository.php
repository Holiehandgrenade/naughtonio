<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 9/29/17
 * Time: 1:57 PM
 */

namespace App\Repositories;


class ThronesSearcherRepository
{
    public function getAllCharacters()
    {
        return collect(json_decode(\Storage::get('public/characters.json')))->filter(function ($n) {
            return $n->Spouse || $n->Allegiances;
        });
    }
}