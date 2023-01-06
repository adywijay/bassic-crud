<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Jabatan extends FormRequest
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
            'jabatan_code' => 'required|max:15|min:5',
            'jabatan_name' => 'required|max:100|min:10'
        ];
    }
}