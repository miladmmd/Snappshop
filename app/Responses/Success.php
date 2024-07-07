<?php

namespace App\Responses;

use App\Trait\ResponseParser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;


class Success
{
    use ResponseParser;
    public function ok(array|string $message = null, array|JsonResource|Collection $data = []): JsonResponse
    {
        return $this->standardResp(
            statusCode: Response::HTTP_OK,
            message: $message,
            data: $data
        );
    }

    public function created(array|string $message = null, array|JsonResource|Collection $data = []): JsonResponse
    {
        return $this->standardResp(
            statusCode: Response::HTTP_CREATED,
            message: $message,
            data: $data
        );
    }
}
