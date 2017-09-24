<?php

namespace App\Http\Routing;

use App\Models\ModelInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

trait JsonResponseBuilderTrait
{
    /**
     * @return JsonResponse
     */
    protected function respondWithUnauthorized()
    {
        return $this->respondWithError(
            ResourceControllerInterface::ERROR_UNAUTHORIZED,
            Response::HTTP_UNAUTHORIZED
        );
    }

    /**
     * @return JsonResponse
     */
    protected function respondWithNotFound()
    {
        return $this->respondWithError(
            ResourceControllerInterface::ERROR_NOT_FOUND,
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * @param string  $errorMessage
     * @param integer $statusCode
     * @return JsonResponse
     */
    protected function respondWithError(string $errorMessage, int $statusCode)
    {
        if ($statusCode === 0) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }
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
        $response = ['data' => []];
        if (is_a($output, ModelInterface::class)) {
            $response['data'] = $output->toArray();
        } elseif (is_a($output, Collection::class)) {
            foreach ($output as $datum) {
                $response['data'][] = $datum->toArray();
            }
        }
        return response()->json($response)->setStatusCode($statusCode);
    }
}
