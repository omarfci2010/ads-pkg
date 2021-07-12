<?php

namespace Kwreach\Ads\Requests\Ad;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Kwreach\Ads\Traits\StatusCodeTrait;

class AddAdRequest extends FormRequest
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
            "type" => "required|string|" . Rule::in(['free', 'paid']),
            "category_id" => "required|integer|exists:categories,id",
            "advertiser_id" => "required|integer|exists:advertisers,id",
            "tags_ids" => "required|array",
            "start_date" => "required|date:Y-m-d",
            "description" => "nullable|string"
        ];
    }
    public function messages(): array
    {
        return [
            "type.in" => "type must be in [free , paid]",
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
