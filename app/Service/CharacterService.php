<?php

namespace App\Service;

use App\Models\Character;
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

    public function createCharacter(array $validated, Member $member)
    {
        return Character::create([
            'nickname' => $validated['nickname'],
            'status' => $validated['status'],
            'character_type_id' => $validated['character_type'],
            'link' => $validated['link'] ?: '',
            'member_id' => $member->id,
        ]);
    }
}
