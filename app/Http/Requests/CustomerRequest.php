<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomerRequest extends FormRequest
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
        $nameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.|\w| )[a-zA-Z0-9])*[a-zA-Z0-9]*/';
        $usernameRegEx = '/^[a-zA-Z0-9]*([a-zA-Z0-9](_|\.)[a-zA-Z0-9])*[a-zA-Z0-9]*/';
        $mobileRegEx = '/^[\+]?[0-9]*/';
        $emailRegEx = '/^[a-zA-Z0-9]+[@][a-zA-Z0-9]+[\.][a-zA-Z0-9]+/';
        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/';
        return [
            'name' => ['required','max:100','regex:'.$nameRegEx],
            'username' => ['required','string','max:50','regex:'.$usernameRegEx, 'unique:customers,username,'.Auth::user()->id],
            'mobile' => ['required','min:3','max:14','regex:'.$mobileRegEx,'unique:customers,mobile,'.Auth::user()->id],
            'email' => ['required','regex:'.$emailRegEx,'unique:customers,email,'.Auth::user()->id],
            'image'=>'required_without:edit|image|mimes:jpeg,webp,png,jpg,gif,svg',
            'password' => ['required_without:edit','confirmed','min:6','regex:'.$passwordRegEx],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'image.required_without' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.',
            'image.image' => 'The :attribute must be of type image.',
            'mimes' => 'The :attribute must be of time jpeg,webp,png,jpg,gif,svg.'
        ];
    }
}
