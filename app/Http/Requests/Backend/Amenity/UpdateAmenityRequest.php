<?php

namespace App\Http\Requests\Backend\Amenity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAmenityRequest extends FormRequest
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
            'name' => 'required|unique:amenities,name,' . $this->id,
            'status' => 'sometimes|nullable|in:active,inactive',
            'position' => 'required|numeric',
        ];
    }
}
