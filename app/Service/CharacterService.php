<?php

namespace App\Service;

use App\Models\Member;

class CharacterService
{
    public function checkIfMainExists(string $status, Member $member)
    {
        if ($status === 'main'){

            foreach ($member->characters as $character){
                if ($character->status === 'main'){
                    throw new \Exception('Вы уже создали основу');
                }
            }
        }

        return true;
    }
}
