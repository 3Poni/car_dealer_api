<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequestRequest extends FormRequest
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
            'carId' => 'required|exists:cars,id',
            'programId' => 'required|exists:credit_programs,id',
            'initialPayment' => 'required|numeric|min:0',
            'loanTerm' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'carId.required' => 'Поле "carId" обязательно.',
            'carId.exists' => 'Указанный автомобиль не найден.',

            'programId.required' => 'Поле "programId" обязательно.',
            'programId.exists' => 'Указанная кредитная программа не найдена.',

            'initialPayment.required' => 'Укажите первоначальный взнос.',
            'initialPayment.numeric' => 'Первоначальный взнос должен быть числом.',
            'initialPayment.min' => 'Первоначальный взнос не может быть отрицательным.',

            'loanTerm.required' => 'Укажите срок кредита.',
            'loanTerm.integer' => 'Срок кредита должен быть целым числом.',
            'loanTerm.min' => 'Срок кредита должен быть хотя бы 1 месяц.',
        ];
    }
}
