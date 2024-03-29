<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, array>
     */
    public function rules() : array
    {
        return [
            'classe_id' => ['required','numeric'],
            'country_id' => ['required','numeric'],
            'first_name' => ['required','string','min:2'],
            'last_name' => ['required','string','min:2'],
            'birthday' => ['required','date'],
            'where_birthday' => ['required','string', 'min:2'],
            'kind' => ['required', 'boolean'],
            'address' => ['required','string','min:2'],
            'father_name' => ['string','min:2'],
            'father_phone' => ['numeric','unique:students'],
            'father_nin' => ['required', 'unique:students'],
            'mother_first_name' => ['string','min:2'],
            'mother_last_name' => ['string','min:2'],
            'mother_phone' => ['numeric','unique:students'],
            'mother_nin' => ['required', 'unique:students']
        ];
    }
}
