<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'files' => 'nullable|array|max:3',
            'files.*' => 'file|mimes:png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'O produto deve ser informado.',
            'product_id.exists' => 'O produto informado é inválido.',
            'files.array' => 'O arquivos devem ser fornecedidos corretamente.',
            'files.max' => 'O máximo de arquivos enviados não pode ser superior a 3.',
            'files.*.file' => 'Os arquivos enviados devem ser válidos.',
            'files.*.mimes' => 'O tipo do arquivo deve ser png ou jpg.',
        ];
    }
}
