<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract  public function rules(); // abstract not allowed to write body;

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        if (!empty($errors)) {
            $errorsList = [];
            foreach ($errors as $field => $msg) {
                $errorsList = [
                    $field => $msg[0]
                ];
            }
            throw new HttpResponseException(
                response()->json(
                    [
                        'status' => 'error',
                        'errors' => $errorsList
                    ],
                    JsonResponse::HTTP_BAD_REQUEST
                )
            );
        }
    }
}
