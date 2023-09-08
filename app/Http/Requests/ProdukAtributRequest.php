<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukAtributRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Define the custom rule directly in the rules method
    Validator::extend('required_if_size_not_null', function ($attribute, $value, $parameters, $validator) {
        // $parameters[0] is the name of the size field
        $sizeField = $parameters[0];

        // Get the value of the size field from the request data
        $sizeFieldValue = $validator->getData()[$sizeField];

        // Check if the size field is not null and the value is not empty
        return !is_null($sizeFieldValue) && !empty($value);
    });
        $rules = [
            'size' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];

        if (!Request::instance()->has('size')) {
            $rules += [
                'status' => 'nullable',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ];
        } else {
            $rules += [
                // 'status' => 'nullabel',
                'status' => 'required_if:size,value',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
        ];
    }

    public function attributes()
    {
        return [
            'size' => 'Ukuran',
            'harga' => 'Harga',
            'stok' => 'Stok',
            'foto' => 'Foto',
            'status' => 'Status',
        ];
    }
}
