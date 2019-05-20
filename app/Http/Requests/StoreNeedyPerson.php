<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNeedyPerson extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'line_1' => ['required', 'string', 'max:100'],
            'line_2' => ['nullable', 'string', 'max:100'],
            'line_3' => ['nullable', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:60'],
            'county_province' => ['required', 'string', 'max:60'],
            'region' => ['required', 'string', 'max:60'],
            'zip_postal_code' => ['required', 'string', 'max:10'],
            'country' => ['required', 'string', 'max:100'],
            'terms' => ['required'],
        ];
    }
}
