<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'actor_name' => 'required|string',
            'birth_date' => 'required|date',
            'image' => 'nullable|image'
        ];
    }
}
