<?php

namespace App\Http\Requests;

use App\Enums\Countries;
use Illuminate\Foundation\Http\FormRequest;

class SearchJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $countries = collect(Countries::cases())->map(
            fn (Countries $country) => $country->value
        )->toArray();
        $countriesStr = implode(',', $countries);

        return [
            'keywords' => 'nullable|max:50',
            'country' => "nullable|in:${countriesStr}",
        ];
    }
}
