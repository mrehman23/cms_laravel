<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Posts extends FormRequest
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
            'category_id' => 'required|integer',
            'lan' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png|max:400|dimensions:max_width=1080,max_height=1080',
            'weight' => 'required|max:2',
            'tags' => 'nullable|array',
        ];
    }
}
