<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            // User Table
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            // Employee Table

            'designation_id' => [
                'required',
                'exists:designations,id',
            ],

            'reporting_manager_id' => [
                'nullable',
                'exists:employees,id',
            ],

            'salary' => [
                'required',
                'numeric',
                'min:0',
            ],

            'dob' => [
                'required',
                'date',
                'before_or_equal:today',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            ],

            'phone' => [
                'required',
                'digits_between:10,15',
            ],

            'address' => [
                'required',
                'string',
            ],

            'gender' => [
                'required',
                Rule::in(['Male', 'Female', 'Other']),
            ],

            'employment_type' => [
                'required',
                Rule::in([
                    'full-time',
                    'part-time',
                    'contract',
                    'intern',
                    'temporary',
                    'freelance'
                ]),
            ],

            'joining_date' => [
                'required',
                'date',
            ],

            'emergency_contact_name' => [
                'required',
                'string',
                'max:255',
            ],

            'emergency_contact_number' => [
                'required',
                'digits_between:10,15',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'                      => 'This email address is already registered.',
            'designation_id.exists'             => 'Please select a valid designation.',
            'reporting_manager_id.exists'       => 'Please select a valid reporting manager.',
            'dob.before_or_equal'               => 'Employee must be at least 18 years old and DOB cannot be a future date.',
            'salary.numeric'                    => 'Salary must be numeric.',
            'phone.digits_between'              => 'Phone number must be between 10 and 15 digits.',
            'emergency_contact.digits_between'  => 'Emergency contact number must be between 10 and 15 digits.',
        ];
    }
}
