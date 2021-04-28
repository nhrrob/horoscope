<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZodiacSignScoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
}