<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleriesFormRequest extends FormRequest
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
            'title' => 'string|required|min:2|max:255',
            'description' => 'max:1000',
            'images' => 'required|array|min:1',
            'images.*' => ['regex:/^(http)?s?:?(\/\/[^\']*\.(?:png|jpg|jpeg))/']
        ];
    }
}
