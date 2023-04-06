<?php

declare(strict_types=1);

namespace App\Helper;

use App\Dto\AbstractResponseDto;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    /**
     * @param string[] $headers
     */
    #[OA\Schema(
        schema: 'SuccessResponse',
        properties: [new OA\Property(
            property: 'message',
            type: 'string',
        )],
    )]
    public static function success(
        string $message = 'Success',
        int $status = Response::HTTP_OK,
        array $headers = [],
    ): JsonResponse {
        return new JsonResponse(
            data: ['message' => $message],
            status: $status,
            headers: $headers
        );
    }

    public static function fail(string $message = 'Error'): JsonResponse
    {
        return new JsonResponse(
            data: ['message' => $message],
            status: Response::HTTP_INTERNAL_SERVER_ERROR,
        );
    }

    public static function unauthorised(string $message = 'Unauthorised'): JsonResponse
    {
        return new JsonResponse(
            data: ['message' => $message],
            status: Response::HTTP_UNAUTHORIZED,
        );
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return new JsonResponse(
            data: ['message' => $message],
            status: Response::HTTP_FORBIDDEN,
        );
    }

    /**
     * @param mixed[] $errors
     */
    public static function errors(array $errors = [], int $status = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return new JsonResponse(
            data: ['errors' => $errors],
            status: $status,
        );
    }

    /**
     * @param string[] $headers
     */
    public static function response(mixed $resource, int $status = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        return new JsonResponse(
            data: $resource,
            status: $status,
            headers: $headers,
        );
    }

    /**
     * @param AbstractResponseDto[] $collection
     * @param string[]              $headers
     * @param mixed[]               $additional_fields
     */
    #[OA\Schema(
        schema: 'ApiResponseList',
        required: ['total_count', 'count', 'items'],
        properties: [
            new OA\Property(property: 'total_count', type: 'number'),
            new OA\Property(property: 'count', type: 'number'),
        ],
    )]
    public static function responseList(array $collection, ?int $totalCount = null, array $headers = [], array $additional_fields = []): JsonResponse
    {
        return new JsonResponse(
            data: [
                'count' => count($collection),
                'total_count' => $totalCount ?? count($collection),
                ...$additional_fields,
                'items' => $collection,
            ],
            status: Response::HTTP_OK,
            headers: $headers,
        );
    }
}
