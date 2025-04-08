<?php

namespace Modules\Medicine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtcCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Allow all users or implement your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'parent_id' => 'nullable|exists:atc_codes,id', // Must reference an existing ATC code or be null
            'name' => 'required|string|max:255', // Required, string, max length 255
            'code' => 'required|string|max:255|unique:atc_codes,code,' . request()->route('atc_code'), // Unique code, except for the current record during updates
            'level' => 'required|integer|min:1|max:5', // Must be an integer between 1 and 5
            'status' => 'required|string|in:active,inactive', // Must be 'active' or 'inactive'
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'parent_id.exists' => 'The selected parent ID does not exist.',
            'name.required' => 'The name field is required.',
            'code.required' => 'The code field is required.',
            'code.unique' => 'The code must be unique.',
            'level.required' => 'The level field is required.',
            'level.min' => 'The level must be at least 1.',
            'level.max' => 'The level must not exceed 5.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
