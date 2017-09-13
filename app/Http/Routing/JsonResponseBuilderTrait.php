<?php

namespace App\Http\Routing;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait JsonResponseBuilderTrait
{
    /**
     * @return JsonResponse
     */
    protected function respondWithNotFound()
    {
        return $this->respondWithError('Support for this action does not yet exist.', Response::HTTP_NOT_FOUND);
    }

    /**
     * @param string  $errorMessage
     * @param integer $statusCode
     * @return JsonResponse
     */
    protected function respondWithError(string $errorMessage, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json(
            [
                'error' => [
                    'status' => $statusCode,
                    'detail' => $errorMessage,
                ]
            ]
        )->setStatusCode($statusCode);
    }

    /**
     * @param mixed   $output
     * @param integer $statusCode
     * @return JsonResponse
     */
    protected function respond($output, int $statusCode = Response::HTTP_OK)
    {
        $data = [];
        if (is_a($output, Arrayable::class)) {
            $data = $output->toArray();
        } elseif (isset($output[0]) && is_a($output[0], Arrayable::class)) {
            foreach ($output as $datum) {
                $data[] = $datum->toArray();
            }
        }
        return response()->json(['data' => $data])->setStatusCode($statusCode);
    }
}