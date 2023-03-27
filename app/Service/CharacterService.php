<?php

namespace App\Service;

use App\Models\Character;
use App\Models\Member;

class CharacterService
{
    public function checkIfMainExists(string $status, Member $member)
    {
        if ($status === Member::MAIN && $member->characters->contains('status', Member::MAIN)) {
            throw new \Exception('Вы уже создали основу');
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
