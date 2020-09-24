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
            'movie_name' => 'required|string',
            'description' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'release_date' => 'required|integer',
            'image' => 'nullable|image'
        ];
    }
}
