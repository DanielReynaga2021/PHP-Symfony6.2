<?php

namespace App\Controller;

use App\Model\Request\UserRequest;
use App\Service\RequestService;
use App\Service\ResponseService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{

    #[Route('/createUser', name:'createUser', methods:'POST')]
    public function createUser(UserService $userService,ResponseService $responseService, RequestService $requestService ){
        $requestBody = $requestService->getRequestBody(UserRequest::class);
        if ($requestBody instanceof JsonResponse)
             return $requestBody;
        $userService->createUser($requestBody);
        return $responseService->create((object)["result" => "ok"]);
    }
}