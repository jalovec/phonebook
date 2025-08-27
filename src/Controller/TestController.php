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

    #[Route(path: '/hello', name: 'hello_route')]
    public function hello(): Response
    {
        $hello = $this->testService->getGreating('Hello');

        return $this->render(
            'test/hello.html.twig', [
                'hello' => $hello
            ]
        );
    }

    #[Route(path: '/bye', name: 'bye_route')]
    public function bye(): Response
    {
        $bye = $this->testService->getGreating('Bye');

        return $this->render(
            'test/bye.html.twig', [
                'bye' => $bye
            ]
        );
    }

    #[Route(path: '/count', name: 'count_route')]
    public function count(): Response
    {
        $bye = $this->testService->add(2, 3);

        return $this->render(
            'test/bye.html.twig', [
                'bye' => $bye
            ]
        );
    }
}
