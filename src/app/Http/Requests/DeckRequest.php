<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeckRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'deck'=>'required|max:50',
            'id'=> 'required|array',
            'number'=> 'required|array',
            'number.*'=> 'integer|min:1|max:4',
        ];
    }

    public function messages()
    {
        return [
            'deck.required'=>'デッキ名が未入力です',
            'deck.max:50'=>'50文字以下で入力してください',
            'id.required'=>'カードが未入力です',
            'number.required'=>'枚数が未入力です',
            'number.*.integer'=>'入力は数字のみ',
            'number.*.min'=>'カード枚数下限は1枚',
            'number.*.max'=>'カード枚数上限は4枚',
        ];
    }
}
