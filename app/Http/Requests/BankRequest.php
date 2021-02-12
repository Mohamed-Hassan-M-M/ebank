<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'id' => ['nullable','numeric','digits_between:1,10','unique:banks,id,'.$this->old_id],
            'name' => 'required|string|max:100',
            'mobile' => ['nullable','numeric','digits_between:5,20','unique:banks,mobile,'.$this->old_id],
            'website' => ['nullable','url','unique:banks,website,'.$this->old_id],
            'email' => ['required','email','unique:banks,email,'.$this->old_id],
            'image'=>'required_without:edit|image|mimes:jpeg,webp,png,jpg,gif,svg',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'image.required_without' => 'The field is required.',
            'unique' => 'The :attribute has already been taken.',
            'image.image' => 'The must be an image.',
            'name.digits_between' => 'The name may not be greater than 100.',
            'id.max' => 'The id should be greater than 1 and less than 10.',
            'mobile.digits_between' => 'The mobile should be greater than 5 and less than 20.',
            'email' => 'The email must be a valid email address.',
            'string' => 'The field must be a string.',
            'numeric' => 'The :attribute must be a number.',
            'url' => 'The url format is invalid.',
            'mimes' => 'The :attribute must be of time jpeg,webp,png,jpg,gif,svg.'
        ];
    }
}
