<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required|unique:products',
            'price' => 'required|integer|min:1',
            'weight' => 'nullable|integer|min:1',
            'qty' => 'required|integer|min:1',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
