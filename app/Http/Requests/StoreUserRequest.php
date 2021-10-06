<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:dns|unique:users|max:255',
            'username' => 'required|string|unique:users|min:3|max:255|alpha_dash',
            'password' => 'required|min:8',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
