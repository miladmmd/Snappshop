<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class P2pRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'from' => 'required|min:16|max:16',
            'to' => 'required|min:16|max:16',
            'amount' => [
                'required',
                'numeric',
                'min:'.config('settings.min_system_transaction'),
                'max:'.config('settings.max_system_transaction')
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'amount.min' => __('validation.min_amount'),
            'amount.max' => __('validation.max_amount')
        ];
    }
}
