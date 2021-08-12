<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:255|unique:categories,name,' . $id . 'id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Um nome deve ser fornecido para a categoria',
            'name.max' => 'O nome fornecido para a categoria é muito extenso.',
            'name.unique' => 'O nome fornecido para a categoria já está sendo utilizado.',
        ];
    }
}
