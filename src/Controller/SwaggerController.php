<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

class SwaggerController extends AbstractController
{
    public function __construct(
        private readonly KernelInterface $appKernel,
    ) {
    }

    #[Route('/swagger-ui', name: 'client_swagger_ui', priority: 1)]
    public function index(): Response
    {
        return $this->render('swagger/index.html.twig');

    }

    #[Route('/swagger', name: 'client_swagger_api', priority: 1)]
    public function swagger(): Response
    {
        $swagger = Yaml::parseFile($this->appKernel->getProjectDir().'/docs/openapi/openapi.yaml');

        return $this->json($swagger);
    }
}
