<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\BaseApiController;
use App\Repository\ProjectRepository;
use App\Helper\ApiResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends BaseApiController
{
    public function __construct(
        private readonly ProjectRepository $projectRepository
    ) {
    }

    #[Route(path: '/api/projects', name: 'api_v1_project_list', methods: ['GET'])]
    #[OA\Get(
        path: '/api/projects',
        summary: 'Get user projects',
        // security: [['bearerAuth' => []]],
        tags: ['Projects'],
        responses: [new OA\Response(
            response: '200',
            description: 'Get user projects',
            content: new OA\JsonContent(
                properties: [new OA\Property(
                    property: 'items',
                    type: 'array',
                    items: new OA\Items(type: ProjectResponseDto::class),
                )],
                allOf: [new OA\Schema(ref: '#/components/schemas/ApiResponseList')]
            ),
        )],
    )]
    public function list(): JsonResponse
    {
        $projects = $this->projectRepository->findAll();
        return ApiResponse::responseList($projects);
    }
}
