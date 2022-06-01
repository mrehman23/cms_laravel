<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pages extends FormRequest
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
            'id' => 'nullable',
            'name' => 'required|string|max:140',
            'heading' => 'required|string|max:140',
            'lan' => 'required|string',
            'content' => 'required|string',
            'menu_visible' => 'nullable',
            'weight' => 'required|max:2'
        ];
    }
}
