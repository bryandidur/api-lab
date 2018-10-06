<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\JsonResponse;
use App\Services\UserService;

final class UserController extends Controller
{
    /**
     * The user service.
     *
     * @var App\Services\UserService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param  App\Services\UserService $service
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Get a listing of the users.
     *
     * @return App\Http\Responses\JsonResponse
     */
    public function list(): JsonResponse
    {
        $data = $this->service->list();

        return JsonResponse::make($data);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Responses\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->service->store($request->all());

        return JsonResponse::make($data);
    }

    /**
     * Get the specified user.
     *
     * @param  int  $id
     * @return App\Http\Responses\JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        $data = $this->service->get($id);

        return JsonResponse::make($data);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return App\Http\Responses\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $this->service->update($id, $request->all());

        return JsonResponse::make($data);
    }

    /**
     * Delete the specified user from storage.
     *
     * @param  int  $id
     * @return App\Http\Responses\JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $data = $this->service->delete($id);

        return JsonResponse::make($data);
    }
}
