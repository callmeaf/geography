<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Callmeaf\Geography\Enums\CountryStatus;
use Callmeaf\Geography\Enums\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CountryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-country.form_request_authorizers.country'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'parent_id' => [Rule::exists(config('callmeaf-continent.model'),'id')],
            'status' => [new Enum(CountryStatus::class)],
            'type' => [new Enum(CountryType::class)],
            'name' => ['string','max:255',Rule::unique(config('callmeaf-country.model'),'name')],
            ...slugValidationRules(config('callmeaf-country.model')),
        ],filters: app(config("callmeaf-country.validations.country"))->store());
    }

}
