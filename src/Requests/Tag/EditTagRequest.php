<?php

namespace Kwreach\Ads\Requests\Tag;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Kwreach\Ads\Traits\StatusCodeTrait;

class EditTagRequest extends FormRequest
{
    use StatusCodeTrait;
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
            "title" => "required|string|min:3|max:20",
            "description" => "nullable|string"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => $this->error_status,
            'code' => $this->api_validation_error,
            'message' => implode(', ', $validator->errors()->all()),
        ], 200));
    }
}
