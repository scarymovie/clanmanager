<?php

namespace App\Http\Requests;

use App\Enums\CharacterEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CharacterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'nickname' => ['required', 'max:100'],
            'status' => ['required', new Enum(CharacterEnums::class)],
            'character_type' => ['required', 'exists:App\Models\CharactersType,id'],
            'link' => 'max:255',
            'note' => 'max:255'
        ];

        return $rules;
    }
}
