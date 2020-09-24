<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'genre_name' => 'required|string'
        ];
    }
}
