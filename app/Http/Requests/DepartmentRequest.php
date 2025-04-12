<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // If you want to restrict access to this form, return false and handle authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:departments,name', // Ensure the department name is unique
        ];
    }

    /**
     * Get the custom validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The department name is required.',
            'name.unique' => 'This department already exists. Please choose a different name.', // Custom error message
        
        ];
    }
}
