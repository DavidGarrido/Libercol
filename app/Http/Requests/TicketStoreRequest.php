<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
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
            'total' => ['required', 'integer'],
            'utc' => ['required', 'integer'],
            'point_id' => ['required', 'integer', 'exists:points,id'],
            'creator_id' => ['required', 'integer', 'exists:creators,id'],
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
        ];
    }
}
