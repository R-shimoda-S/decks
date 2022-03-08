<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalcRequest extends FormRequest
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
            'number'=>'required|integer|min:1',
            'card'=>'required|integer|min:1',
            'draw'=>'required|integer|min:1',
        ];
    }

    /**
     * エラーメッセージ内容
     *
     * @return array
     */
    public function messages()
    {
        return [
            'number.required'=>'デッキ枚数が未入力',
            'number.integer'=>'デッキ枚数は数字のみ',
            'number.min'=>'デッキ枚数は1以上で入力',
            'card.required'=>'カード枚数が未入力',
            'card.integer'=>'カード枚数は数字のみ',
            'card.min'=>'カード枚数は1以上',
            'draw.required'=>'初手枚数が未入力',
            'draw.integer'=>'初手枚数は数字のみ',
            'draw.min'=>'初手枚数は1以上',
        ];
    }
}
