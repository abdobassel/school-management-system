<?php


namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class CreateStudent extends ApiRequest
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
        return [
            'name' => 'required|unique:students,name',
            'email' => 'required|unique:students,email',

            'password' => 'required|min:6',
        ];
    }
}
