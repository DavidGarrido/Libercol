<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'modeltable_type' => ['required', 'string'],
            'modeltable_id' => ['required', 'integer', 'gt:0'],
            'wallettype_id' => ['required', 'integer', 'exists:wallettypes,id'],
        ];
    }
}
