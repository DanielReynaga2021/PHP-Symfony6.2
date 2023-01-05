<?php

namespace App\Service;

use App\Entity\Episode;
use App\Entity\Movie;
use App\Model\Response\DirectorResponse;
use App\Model\Response\EpisodeResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
class EpisodeService{
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
    public function getEpisodeAndDirectorBynumberEpisodeAndNameTvShow(int $numberEpisode, string $nameTvShow){
        $episodeAndDirector = $this->em->getRepository(Episode::class)->findEpisodeBynumberEpisodeAndNameTvShow($numberEpisode, $nameTvShow);
        if(empty($episodeAndDirector)){
            throw new BadRequestHttpException('the episode was not found');
        }
        return $this->buildEpisodeAndDirectorResponse($episodeAndDirector);
    }

    private function buildEpisodeAndDirectorResponse(array $episodeAndDirector){
        $episodeResponse = new EpisodeResponse();
        $episodeResponse->setId($episodeAndDirector['idEpisode']);
        $episodeResponse->setName($episodeAndDirector['nameEpisode']?$episodeAndDirector['nameEpisode'] : "");
        $episodeResponse->setNumberEpisode($episodeAndDirector['numberEpisode']?$episodeAndDirector['numberEpisode'] : "");
        if(!empty($episodeAndDirector['releaseDateEpisode'])){
            $episodeResponse->setReleaseDate(date_format($episodeAndDirector['releaseDateEpisode'],"d-m-Y"));
        }

        $directorResponse = new DirectorResponse();
        $directorResponse->setId($episodeAndDirector['idDirector']);
        $directorResponse->setName($episodeAndDirector['nameDirector']?$episodeAndDirector['nameDirector'] : "");
        $directorResponse->setLastName($episodeAndDirector['lastNameDirector']?$episodeAndDirector['lastNameDirector'] : "");
        if(!empty($episodeAndDirector['releaseDateEpisode'])){
            $directorResponse->setDateBirth(date_format($episodeAndDirector['releaseDateEpisode'],"d-m-Y"));
        }    
        return array("Episode" => $episodeResponse, "Director" => $directorResponse);
    }
}