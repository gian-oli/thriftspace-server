<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Traits\ResponseTrait;

class MinerRequest extends FormRequest
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
            "miner_username" => "required",
            // $this->method() === "POST" ? "required|unique:miners,miner_username,NULL,id" : "required|unique:miners,miner_username,{$this->route('miner')},id" ,
            "miner_real_name" => $this->method() === "PATCH" ?"required": "nullable",
        ];
    }

    public function message(){
        return [
            "miner_username.required" => "Miner username is required",
            "miner_real_name" => "Miner real name is required"
        ];
    }

     public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
