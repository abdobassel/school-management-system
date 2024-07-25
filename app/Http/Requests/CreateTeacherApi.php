<?php


namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherApi extends ApiRequest
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
            'email' => 'required|unique:teachers,email|email',
            'password' => 'required',
            'name_ar' => 'required|string|min:2|max:60',
            'name_en' => 'required|string|min:2|max:60',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_Date' => 'required',
            'address' => 'required',

        ];
    }
}
