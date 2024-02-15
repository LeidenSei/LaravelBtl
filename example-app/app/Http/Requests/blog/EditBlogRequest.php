<?php

namespace App\Http\Requests\blog;

use Illuminate\Foundation\Http\FormRequest;

class EditBlogRequest extends FormRequest
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
            'name'=>'required|unique:blogs,name,'.$this->blog->id,
            'slug'=>'required',
            'photo'=>'image',
            'description'=>'',
            'content'=>'required'
        ];
    }
}
