<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse as BaseJsonResponse;

class JsonResponse extends BaseJsonResponse
{
    /**
     * Create a new response instance.
     *
     * @param  array|null  $data
     * @param  int|null    $status
     * @param  array|null  $headers
     * @param  int|null    $options
     * @return void
     */
    public function __construct(?array $data = [], int $status = Response::HTTP_OK, array $headers = [], int $options = 0)
    {
        parent::__construct($data, $this->handleStatusCode($data, $status), $headers, $options);
    }

    /**
     * Make a new class object statically.
     *
     * @see self::__construct()
     */
    public static function make(?array $data = [], int $status = Response::HTTP_OK, array $headers = [], int $options = 0)
    {
        return new self($data, $status, $headers, $options);
    }

    /**
     * Handle the response status code.
     *
     * @param  array  $data
     * @param  int    $status
     * @return int
     */
    protected function handleStatusCode(?array $data, int $status): int
    {
        if ($data === null) {
            return Response::HTTP_NOT_FOUND;
        }

        return $status;
    }
}
