<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'customer_id'      => 'required|exists:customers,id',
            'date'             => 'required|date',
            'total'            => 'required',
            'items'            => 'required|array',
            'items.*.id'       => 'required',
            'items.*.quantity' => 'required',
            'items.*.price'    => 'required',
            'items.*.total'    => 'required'
        ];
    }
}
