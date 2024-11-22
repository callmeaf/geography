<?php

namespace Callmeaf\Geography\Http\Requests\V1\Api;

use Callmeaf\Geography\Enums\ContinentStatus;
use Callmeaf\Geography\Enums\ContinentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ContinentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-continent.form_request_authorizers.continent'))->update();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $continent = $this->route('continent');
        Log::alert($continent->id);
        return validationManager(rules: [
            'status' => [new Enum(ContinentStatus::class)],
            'type' => [new Enum(ContinentType::class)],
            'name' => ['string','max:255',Rule::unique(config('callmeaf-continent.model'),'name')->ignore($continent->id)],
            ...slugValidationRules(config('callmeaf-continent.model'),ignore: $continent->id),
        ],filters: app(config("callmeaf-continent.validations.continent"))->update());
    }

}
