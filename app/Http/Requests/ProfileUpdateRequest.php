<?php

namespace App\Http\Requests;

use App\Models\Employee_Login;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Employee_Login::class)->ignore($this->user()->id)],'emp_fname' => ['required', 'string', 'max:255'],
            'emp_mname' => ['nullable', 'string', 'max:255'],
            'emp_lname' => ['required', 'string', 'max:255'],
            'emp_gender' => ['required', 'string'],
            'emp_dob' => ['required', 'date', 'before_or_equal:today', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->age;
                if ($age < 18) {
                    $fail('You must be at least 18 years old.');
                }
            }],
            'emp_pob' => ['required', 'string', 'max:255'],
            'emp_cStatus' => ['required', 'string'],
            'emp_religion' => ['required', 'string', 'max:255'],
            'emp_blood_type' => ['required', 'string', 'max:3'],
        ];
    }

    public function messages()
    {
        return [
            'emp_dob.before_or_equal' => 'The date of birth cannot be a future date.',
            'emp_dob.required' => 'The date of birth is required.',
        ];
    }
}