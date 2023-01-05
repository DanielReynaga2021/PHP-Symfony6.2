<?php

namespace App\Controller;
use App\Service\MovieService;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController{

    #[Route('/movie', name:'Movies', methods: 'GET')]
    public function getMovies(Request $request, ResponseService $responseService, MovieService $movieService){

        $filterAndOrder = $request->query->all();
        $movie = (object)$movieService->getMovieByFilterAndOrder($filterAndOrder);
        return $responseService->create($movie);
    }
}