<?php

namespace App\Controller;

use App\BindRequest;
use App\Resources\FooBarRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /** @Route("/", name="default") */
    public function index(
        BindRequest $binder,
        $resource = \App\Resources\FooBarRequest::class
    ) {
        $binder->bind($resource);

        if ($binder->isSuccess()) {
            return new JsonResponse([
                'success' => true,
            ]);
        }

        return new JsonResponse([
            'code' => 400,
            'message' => 'invalid request',
        ], 400);
    }
}
