<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiPricesPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "prices" => "required|array",
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["error" => $validator->errors()], 422));
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "prices.required" => "Значение prices обязательно для заполнения",
            "prices.array" => "Значение prices должно быть массивом",
        ];
    }
}
