<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $id = $request->id ?? null;

        return [
            'sku_code' => 'required|max:255|unique:products,sku_code,' . $id . 'id',
            'category_id' => 'required|exists:categories,id',
            'files' => 'nullable|array|max:3',
            'files.*' => 'file|mimes:png,jpg',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'composition' => 'required',
            'size' => 'required',
            'stock' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'sku_code.required' => 'O código do produto deve ser fornecido.',
            'sku_code.max' => 'O código fornecido para o produto é muito extenso.',
            'sku_code.unique' => 'O código fornecido para o produto já está em utilização.',
            'category_id.required' => 'A categoria deve ser fornecida.',
            'category_id.exists' => 'A categoria fornecida é inválida.',
            'name.required' => 'Um nome deve ser fornecido para o produto',
            'name.max' => 'O nome fornecido para o produto é muito extenso.',
            'price.required' => 'O preço do produto deve ser fornecido.',
            'price.numeric' => 'O preço do produto deve ser fornecido corretamente.',
            'composition.required' => 'A composição do produto deve ser fornecida.',
            'size.required' => 'O tamanho do produto deve ser fornecido.',
            'stock.required' => 'A quantidade em estoque deve ser fornecida para o produto.',
            'stock.numeric' => 'A quantidade em estoque deve ser fornecida corretamente para o produto.',
            'files.array' => 'O arquivos devem ser fornecedidos corretamente.',
            'files.max' => 'O máximo de arquivos enviados não pode ser superior a 3.',
            'files.*.file' => 'Os arquivos enviados devem ser válidos.',
            'files.*.mimes' => 'O tipo do arquivo deve ser png ou jpg.',
        ];
    }
}
