<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateCreditRequest extends FormRequest
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
        return [
            'price' => ['required', 'integer', 'min:1'],
            'initialPayment' => ['required', 'numeric', 'min:0'],
            'loanTerm' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => 'Укажите цену автомобиля.',
            'price.integer' => 'Цена должна быть целым числом.',
            'price.min' => 'Минимальная цена — 1 рубль.',

            'initialPayment.required' => 'Укажите первоначальный взнос.',
            'loanTerm.required' => 'Укажите срок кредита.',
        ];
    }
}
