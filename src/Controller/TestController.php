<?php

namespace App\Controller;

use App\Domain\Test\Service\TestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/')]
class TestController extends AbstractController
{
    public function __construct(
        private readonly TestService $testService,
    ) {
    }

    #[Route(path: '/test', name: 'test_route')]
    public function test(): Response
    {
        $dateTime = $this->testService->getDateTime();

        return $this->render(
            'test/index.html.twig', [
            'dateTime' => $dateTime
            ]
        );
    }
}
