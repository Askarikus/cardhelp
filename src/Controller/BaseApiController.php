<?php

declare(strict_types=1);

namespace App\Controller;

use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[OA\OpenApi(
    info: new OA\Info(
        version: '1.0.0',
        title: 'Cardhelp Client Api',
    ),
    servers: [
        new OA\Server(url: 'http://localhost/', description: 'Local server'),
    ]
)]
class BaseApiController extends AbstractController
{
}
