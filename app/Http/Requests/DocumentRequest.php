<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'int|nullable',
            'nome' => [
                'required',
                'min:3',
                //'unique:estoques',
                Rule::unique('documents')->ignore($this->id)->whereNull('deleted_at'),
            ],
            'texto' => [
                'required',
                'gte:0',
            ],
            'createBy' => [
                'required',
            ],
        ];
    }
}
