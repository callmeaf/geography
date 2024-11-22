<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-province.form_request_authorizers.province'))->destroy();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [

        ],filters: app(config("callmeaf-province.validations.province"))->destroy());
    }

}
