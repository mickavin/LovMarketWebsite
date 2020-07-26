<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'nom' => 'required|max:25|string',
            'description' => 'required|max:25|string',
            'prix' => 'required|numeric|between:0,1000.00',
            'nouveau_prix' => 'numeric|between:0,1000.00',
            'img' => 'required|string',
            'categorie' => 'required|numeric|exists:product_categories,id|nullable'
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'prix.numeric' => 'Le champ :attribute doit contenir un nombre, sans symbole € et le séparateur décimal doit être un \'.\'.',
            'nouveau_prix.numeric' => 'Le champ nouveau prix doit contenir un nombre, sans symbole € et le séparateur décimal doit être un \'.\'.',
        ];
    }
}
