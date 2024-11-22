<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-province.form_request_authorizers.province'))->index();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'country_id' => [],
            'parent_id' => [],
            'name' => [],
            'slug' => [],
        ],filters: [
            ...app(config("callmeaf-province.validations.province"))->index(),
            ...config('callmeaf-base.default_searcher_validation'),
        ]);
    }

}
