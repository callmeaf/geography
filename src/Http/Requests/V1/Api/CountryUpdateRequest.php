<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Callmeaf\Geography\Enums\CountryStatus;
use Callmeaf\Geography\Enums\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CountryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-country.form_request_authorizers.country'))->update();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $country = $this->route('country');
        return validationManager(rules: [
            'parent_id' => [Rule::exists(config('callmeaf-continent.model'),'id')],
            'status' => [new Enum(CountryStatus::class)],
            'type' => [new Enum(CountryType::class)],
            'name' => ['string','max:255',Rule::unique(config('callmeaf-country.model'),'name')->ignore($country->id)],
            ...slugValidationRules(config('callmeaf-country.model'),ignore: $country->id),
        ],filters: app(config("callmeaf-country.validations.country"))->update());
    }

}
