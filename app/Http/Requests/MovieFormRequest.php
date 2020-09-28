<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'release_date' => 'required|integer',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|image',
            'actors' => 'required'
        ];
    }
}
