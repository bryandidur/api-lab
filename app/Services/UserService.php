<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserService
{
    /**
     * The user repository.
     *
     * @var App\Repositories\UserRepository
     */
    protected $repository;

    /**
     * The user validator
     *
     * @var App\Validators\UserValidator
     */
    protected $validator;

    /**
     * Create a new service instance.
     *
     * @param  App\Repositories\UserRepository $repository
     * @param  App\Validators\UserValidator $validator
     * @return void
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Get a listing of the users.
     *
     * @return array
     */
    public function list(): array
    {
        return $this->repository->list();
    }

    /**
     * Store a new user on database.
     *
     * @param  array  $data
     * @return array
     */
    public function store(array $data): array
    {
        $this->validator->store($data);

        return $this->repository->store($data);
    }

    /**
     * Get a specified user from storage.
     *
     * @param  int  $id
     * @return array|null
     */
    public function get(int $id): ?array
    {
        return $this->repository->get($id);
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
        $this->validator->update($data, compact('id'));

        return $this->repository->update($id, $data);
    }

    /**
     * Delete a specified user from storage.
     *
     * @param  int  $id
     * @return array|null
     */
    public function delete(int $id): ?array
    {
        return $this->repository->delete($id);
    }
}
