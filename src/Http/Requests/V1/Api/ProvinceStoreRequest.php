<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Callmeaf\Geography\Enums\ProvinceStatus;
use Callmeaf\Geography\Enums\ProvinceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProvinceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-province.form_request_authorizers.province'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'country_id' => [Rule::exists(config('callmeaf-country.model'),'id')],
            'parent_id' => [Rule::exists(config('callmeaf-province.model'),'id')],
            'status' => [new Enum(ProvinceStatus::class)],
            'type' => [new Enum(ProvinceType::class)],
            'name' => ['string','max:255',Rule::unique(config('callmeaf-province.model'),'name')],
            ...slugValidationRules(config('callmeaf-province.model')),
        ],filters: app(config("callmeaf-province.validations.province"))->store());
    }

}
