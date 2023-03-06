<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;

class DateRangeRequest extends FormRequest
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
            "date_from" => "required|before_or_equal:{$this->date_to}",
            "date_to" => "required|after_or_equal:{$this->date_from}",
        ];
    }

    public function messages()
    {
        return [
            "date_from.required" => "Date From must have data.",
            "date_to.required" => "Date To must have data.",
            "date_from.date" => "Date From must be date.",
            "date_to.date" => "Date To must be date.",
            "date_from.before_or_equal" => "Date From must before or equal to Date To.",
            "date_to.after_or_equal" => "Date To must after or equal Date From."
        ];
    }
    public function failedValidation(Validator $validator){
        $response = $this->failedValidationResponse($validator->errors());
        throw new HttpResponseException(response()->json($response));
    }
}
