<?php

namespace App\Service;

use App\Entity\Director;
use App\Entity\Movie;
use App\Enum\ExceptionEnum;
use App\Model\Request\DataShowRequest;
use App\Model\Response\MovieResponse;
use App\Repository\MovieRepository;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


class MovieService implements IDataShowInterface{

    /**
     * @var EntityManagerInterface
    */
    private $em;

    /**
     * @var DirectorService
    */
    private $directorService;
    function __construct(
        EntityManagerInterface $em,
        DirectorService $directorService, 
    )
    {
        $this->em = $em;
        $this->directorService = $directorService;  
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

    public function addDataShow(DataShowRequest $dataShowRequest){
        $directorId = $dataShowRequest->getMovie()->getDirectorId();
        if(!$directorId){
            throw new BadRequestHttpException(ExceptionEnum::EMPTY);
        }
        $directorEntity = $this->directorService->getDirector($directorId);
        $userEntity = $this->builDataShow($dataShowRequest, $directorEntity);
        $this->em->persist($userEntity);
        $this->em->flush();
    }

    private function builDataShow(DataShowRequest $dataShowRequest, Director $directorEntity){
        $movieEntity = new Movie();
        $movieEntity->setName($dataShowRequest->getMovie()->getName()?$dataShowRequest->getMovie()->getName(): "");
        $movieEntity->setReleaseDate($dataShowRequest->getMovie()->getReleaseDate() ? $dataShowRequest->getMovie()->getReleaseDate() : "");
        $movieEntity->setDirector($directorEntity);
        $movieEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $movieEntity;
    }
}