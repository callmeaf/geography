<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Callmeaf\Geography\Enums\CountryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProvinceStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-province.form_request_authorizers.province'))->statusUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(CountryStatus::class)],
        ],filters: app(config("callmeaf-province.validations.province"))->statusUpdate());
    }

}