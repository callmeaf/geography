<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class CountryIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-country.form_request_authorizers.country'))->index();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'parent_id' => [],
            'name' => [],
            'slug' => [],
        ],filters: [
            ...app(config("callmeaf-country.validations.country"))->index(),
            ...config('callmeaf-base.default_searcher_validation'),
        ]);
    }

}
