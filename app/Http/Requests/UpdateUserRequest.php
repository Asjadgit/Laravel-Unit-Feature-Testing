<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user')?->id;

        return [
            'name'     => ['required', 'string', 'max:255'],

            // ignore current user email for unique check
            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            // password optional on update
            'password' => ['nullable', 'min:6'],

            'role'     => ['required'],

            // avatar optional (keep old if not updated)
            'avatar'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'status'   => ['nullable'],
        ];
    }
}
