<?php

namespace App\Controller;

use App\Model\Request\DataShowRequest;
use App\Service\DataShow\DataShowService;
use App\Service\RequestService;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DataShowController extends AbstractController
{
    #[Route('/api/dataShow', name:'DataShow', methods:'POST')]
    public function SaveDataShow(Request $request, DataShowService $dataShowService, ResponseService $responseService, RequestService $requestService)
    {
        $requestBody = $requestService->getRequestBody(DataShowRequest::class);
        if ($requestBody instanceof JsonResponse)
             return $requestBody;
        $dataShowService->saveDataShow($requestBody);
        return $responseService->create((object)["result" => "ok"]);
    }
}