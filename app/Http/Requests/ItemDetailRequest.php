<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemDetailRequest extends FormRequest
{
    use ResponseTrait;
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
            "live_id" => "required",
            "process_id" => $this->method() === "PATCH" ? "required": "",
            "miner_username" => "required",
            "size" => "required",
            "price" => "required",
        ];
    }

    public function messages(){
        return [
            "live_id.required" => "Live ID is required",
            "process_id.required" => $this->method() === "PATCH" ? "Item Status is required": "",
            "miner_username.required" => "Miner username is required",
            "size.required" => "Size is required",
            "price" => "Price is required"
        ];
    }

    public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
