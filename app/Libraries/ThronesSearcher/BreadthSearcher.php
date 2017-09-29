<?php

namespace App;

class BreadthSearcher
{
    public $start, $end, $cameFrom, $characters, $houses;

    public function __construct()
    {
        // remove characters who don't have allegiances
        $this->characters = collect(json_decode(\Storage::get('public/characters.json')))->filter(function ($n) {
            return $n->Spouse || $n->Allegiances;
        });

        // get all houses
        $this->houses = collect(json_decode(\Storage::get('public/houses.json')));
    }

    public function search()
    {
        $frontier = collect([$this->start]);

        while ( ! $frontier->isEmpty()) {
            // remove the first element from frontier as "current"
            $current = $frontier->splice(0,1)->first();

            // for each neighboring term and what house they came from
            foreach ($this->getNeighbors($current) as $relationship) {
                $neighbor = $relationship['neighbor'];

                // push neighbor id onto the frontier
                $frontier->push($neighbor);

                // build a map of who came from who through what house
                $this->cameFrom->put($neighbor, [
                    'character' => $current,
                    'method' => $relationship['method'],
                    'vessel' => $relationship['vessel'],
                ]);

                // if the neighbor is the character we're looking for
                // return true that a connection has been found
                if ($neighbor == $this->end) {
                    return true;
                }
            }
        }

        // if the whole map is searched and reached this point, no path is found
        return false;
    }

    public function getNeighbors($id)
    {
        $currentCharacter = $this->characters->where('Id', $id)->first();
        $mappedNeighbors = [];

        foreach ($this->characters as $character) {

            // if we've already mapped the character, skip
            if ($this->cameFrom->has($character->Id)) continue;

            // if this character is the spouse
            if ($character->Id == $currentCharacter->Spouse) {
                $this->addNeighbor($mappedNeighbors, $character, 'married_to', null);
                continue;
            }

            // if this character has a mutual house allegiance
            $intersectingAllegiances = array_values(array_intersect($character->Allegiances, $currentCharacter->Allegiances));
            if ($intersectingAllegiances) {
                // if there are multiple shared houses, just grab the first one
                $this->addNeighbor($mappedNeighbors, $character, 'shared_house', $intersectingAllegiances[0]);
                continue;
            }
        }

        // scramble up the neighbors to get different possible paths
        shuffle($mappedNeighbors);
        return $mappedNeighbors;
    }

    public function findChain($start = null, $end = null)
    {
        // start, end, current are all character Ids
        $this->start = $start ? $start : $this->characters->random()->Id;
        $this->end = $end ? $end : $this->characters->random()->Id;
        $this->cameFrom = collect([$this->start => null]);

        $found = $this->search();

        if ( ! $found) {
            dd('no connections found');
        }


        // getting to this point, we can assume a path exists. No risk of infinite while-looping
        $current = $this->end;
        $path = collect();

        while ($current != $this->start) {
            // get the character and the house they are related to
            $characterName = $this->characters->where('Id', $current)->first()->Name;
            $method = $this->cameFrom[$current]['method'];

            switch ($method) {
                case 'married_to':
                    $path->put($characterName, "Married To");
                    break;
                case 'shared_house':
                    $house = $this->houses->where('Id', $this->cameFrom[$current]['vessel'])->first()->Name;
                    $path->put($characterName, "Mutual Allegiance: " . $house);
                    break;
            }

            // get the next character
            $current = $this->cameFrom[$current]['character'];
        }

        // finally stick the start on the end
        $path->put($characterName = $this->characters->where('Id', $this->start)->first()->Name, '');
        dd($path);
    }


    private function addNeighbor(&$array, $character, $method, $vessel)
    {
        $array[] = [
            'neighbor' => $character->Id,
            'method' => $method,
            'vessel' => $vessel
        ];
    }
}
