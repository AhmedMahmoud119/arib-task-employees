<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user'); // Assuming 'user' is the parameter name in your route
        $pass = Password::min(8) // Minimum length
        ->mixedCase() // Must contain both uppercase and lowercase letters
        ->numbers() // Must contain at least one number
        ->symbols();

        return [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'phone' => 'required|unique:users,phone,' . ($userId ? $userId->id : null),
            'password' => $userId ? ['nullable','confirmed',$pass] : ['required','confirmed',$pass],
            'salary' => 'required',
            'manager_id'  => 'nullable|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ];
    }
}
