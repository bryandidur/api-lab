<?php

namespace App\Repositories;

use App\Entities\User;

class UserRepository
{
    /**
     * Get a listing of the users.
     *
     * @return array
     */
    public function list(): array
    {
        return User::all()->toArray();
    }

    /**
     * Store a new user in database.
     *
     * @param  array  $data
     * @return array
     */
    public function store(array $data): array
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ])->toArray();
    }

    /**
     * Get a specified user from storage.
     *
     * @param  int  $id
     * @return array|null
     */
    public function get(int $id): ?array
    {
        $user = User::find($id);

        if ($user) {
            return $user->toArray();
        }

        return null;
    }

    /**
     * Update a specified user in storage.
     *
     * @param  int    $id
     * @param  array  $data
     * @return array|null
     */
    public function update(int $id, array $data): ?array
    {
        $user = User::find($id);

        if ($user) {
            $user->fill([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => ! empty($data['password']) ? bcrypt($data['password']) : $user->password,
            ])->save();

            return $user->toArray();
        }

        return null;
    }

    /**
     * Delete a specified user from storage.
     *
     * @param  int  $id
     * @return array|null
     */
    public function delete(int $id): ?array
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return $user->toArray();
        }

        return null;
    }
}
