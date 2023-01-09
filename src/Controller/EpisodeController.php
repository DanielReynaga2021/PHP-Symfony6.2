<?php

namespace App\Controller;

use App\Service\EpisodeService;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EpisodeController extends AbstractController
{

    #[Route('/api/episode/{numberEpisode}/{nameTvShow}', name:'Episode', methods:'GET')]
    function getEpisodeAndDirector(int $numberEpisode, string $nameTvShow, EpisodeService $episodeService, ResponseService $responseService, Request $request){
        $episode = (object) $episodeService->getEpisodeAndDirectorBynumberEpisodeAndNameTvShow($numberEpisode, $nameTvShow);
        return $responseService->create($episode);
    }
}
