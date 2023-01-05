<?php

namespace App\Service;

use App\Entity\Movie;
use App\Model\Response\MovieResponse;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;


class MovieService{

    /**
     * @var EntityManagerInterface
    */
    private $em;
    function __construct(
        EntityManagerInterface $em,   
    )
    {
        $this->em = $em;     
    }
    public function getMovieByFilterAndOrder(array $filterAndOrder){
        $movie = $this->em->getRepository(Movie::class)->findMovie($filterAndOrder);
        return $this->buildMovieResponse($movie);
    }

    private function buildMovieResponse(array $movie){
        $movieArray = [];
        foreach($movie as $value){
            $movieResponse = new MovieResponse();
            $movieResponse->setId($value->getId());
            $movieResponse->setName($value->getName());
            $movieResponse->setReleaseDate(date_format($value->getReleaseDate(),"d-m-Y"));
            array_push($movieArray, $movieResponse);
        }
        return array("Movies" => $movieArray);
    }
}