<?php

namespace App\Controller;

use App\Resources\SomeObject;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\BindRequest;

class DefaultController extends Controller
{
    /** @Route("/", name="default") */
    public function index(BindRequest $binder)
    {
        $binder->bind(\App\Resources\SomeObject::class);

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
