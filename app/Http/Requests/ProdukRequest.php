<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProdukRequest extends FormRequest
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
            'kategori' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
        ];

        if (!Request::instance()->has('id')) {
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
            'nama' => 'Nama',
            'kategori' => 'Kategori',
            'deskripsi' => 'Deskripsi',
            'foto' => 'Foto',
            'status' => 'Status',
        ];
    }
}
