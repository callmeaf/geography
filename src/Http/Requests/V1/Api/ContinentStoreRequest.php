<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Callmeaf\Geography\Enums\ContinentStatus;
use Callmeaf\Geography\Enums\ContinentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ContinentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-continent.form_request_authorizers.continent'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(ContinentStatus::class)],
            'type' => [new Enum(ContinentType::class)],
            'name' => ['string','max:255',Rule::unique(config('callmeaf-continent.model'),'name')],
            ...slugValidationRules(config('callmeaf-continent.model')),
        ],filters: app(config("callmeaf-continent.validations.continent"))->store());
    }

}
