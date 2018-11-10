<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Validator;

class UserValidator extends namespace\BaseValidator
{
    /**
     * Get the validation rules for storage.
     *
     * @param  array  $data
     * @return array
     */
    public function storeRules(array $data): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * Get the validation rules for update.
     *
     * @param  array  $data
     * @return array
     */
    public function updateRules(array $data): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$this->params['id']}",
            'password' => 'nullable|string|min:6',
        ];
    }
}
