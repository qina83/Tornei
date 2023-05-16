<?php

namespace App\Security\Infrastructure;

use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/security')]
class LoginController extends AbstractController
{
    #[Route('/login', name: 'securiy_login', methods: ['POST'])]
    public function login(Request $request): Response
    {
        $credential = json_decode($request->getContent(), true);

        $token = Uuid::uuid4();

        return new JsonResponse([
            'token' => $token
        ]);
    }
}
