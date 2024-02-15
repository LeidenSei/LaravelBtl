<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'=>'required|min:2',
            'address'=>'required',
            'email'=>'required',
            'phone'=>['required','regex:/(84|0[3|5|7|8|9])+([0-9]{8})/','max:10'],
            'payType'=>'required|in:1,2'
        ];
    }
}
