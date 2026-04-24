<?php

namespace App\Http\Requests\Order;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    use FailedValidation;

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
     * @return array
     */
    public function rules(): array
    {
        return [
            'customerId' => 'required|numeric',
            'items' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'customerId.required' => 'Не указан покупатель',
            'items.required' => 'Не указаны товары'
        ];
    }
}
