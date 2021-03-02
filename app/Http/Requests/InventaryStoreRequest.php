<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventaryStoreRequest extends FormRequest
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
            'point_id' => ['required', 'integer', 'exists:points,id'],
            'asset_id' => ['required', 'integer', 'exists:assets,id'],
        ];
    }
}
