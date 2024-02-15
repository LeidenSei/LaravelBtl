<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|unique:products',
            'slug'=>'required',
            'price'=>'required|numeric',
            'sale_price'=>'min:0|lte:price|numeric',
            'category_id'=>'required',
            'photo'=>'required|image',
            'description'=>'',
            'photos'=>'required'
        ];
    }
}
