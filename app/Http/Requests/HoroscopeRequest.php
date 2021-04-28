<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoroscopeRequest extends FormRequest
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