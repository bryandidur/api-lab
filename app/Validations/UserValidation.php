<?php

namespace App\Validations;

use Validator as ValidatorFactory;
use Illuminate\Contracts\Validation\Validator;

trait UserValidation
{
    /**
     * Validate the user storage.
     *
     * @param  array  $data
     * @return void
     */
    public function validateStorage(array $data): void
    {
        $this->storageValidator($data)->validate();
    }

    /**
     * Make the validator instance for the user storage.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function storageValidator(array $data): Validator
    {
        return ValidatorFactory::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Validate the user update.
     *
     * @param  int    $id
     * @param  array  $data
     * @return void
     */
    public function validateUpdate(int $id, array $data): void
    {
        $this->updateValidator($id, $data)->validate();
    }

    /**
     * Make the validator instance for the user update.
     *
     * @param  int    $id
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(int $id, array $data): Validator
    {
        return ValidatorFactory::make($data, [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,id,{$id}",
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    }
}
