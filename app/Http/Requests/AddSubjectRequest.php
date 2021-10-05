<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AddSubjectRequest extends FormRequest
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
            'name' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

     /**
     * Returns request payload
     *
     * @return array
     */
    public function getData()
    {
        return [
            'title' => $this->title,
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => auth()->user()->id
        ];
    }


     /**
     * Returns validation errors
     *
     * @param Validator $validation
     * @return void
     */
    public function failedValidation(Validator $validation)
    {
        $response = new JsonResponse(
            [
                "success" => false,
                "message" => $validation->errors()->first(),
            ],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );

        throw new HttpResponseException($response);
    }
}
