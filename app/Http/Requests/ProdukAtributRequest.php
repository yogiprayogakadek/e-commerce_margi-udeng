<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
                'status' => 'required',
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
