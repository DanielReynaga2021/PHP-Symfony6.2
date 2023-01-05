<?php

namespace App\Service;

use App\Entity\Episode;
use App\Entity\Season;
use App\Model\Request\DataShowRequest;
use App\Model\Response\DirectorResponse;
use App\Model\Response\EpisodeResponse;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
class EpisodeService implements IDataShowInterface{
    /**
     * @var EntityManagerInterface
    */
    private $em;

    /**
     * @var SeasonService
    */
    private $seasonService;
    function __construct(
        EntityManagerInterface $em, 
        SeasonService $seasonService, 
    )
    {
        $this->em = $em;
        $this->seasonService = $seasonService;     
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

    public function addDataShow(DataShowRequest $dataShowRequest){
        $seasonId = $dataShowRequest->getEpisode()->getSeasonId();
        if(!$seasonId){
            throw new BadRequestHttpException('The attribute is required');
        }
        $seasonEntity = $this->seasonService->getSeason($seasonId);
        $episodeEntity = $this->builDataShow($dataShowRequest, $seasonEntity);
        $this->em->persist($episodeEntity);
        $this->em->flush();
    }

    private function builDataShow(DataShowRequest $dataShowRequest, Season $seasonEntity){
        $episodeEntity = new Episode();
        $episodeEntity->setName($dataShowRequest->getEpisode()->getName() ? $dataShowRequest->getEpisode()->getName() : "");
        $episodeEntity->setNumberEpisode($dataShowRequest->getEpisode()->getNumberEpisode()?$dataShowRequest->getEpisode()->getNumberEpisode(): 0);
        $episodeEntity->setReleaseDate($dataShowRequest->getEpisode()->getReleaseDate() ? $dataShowRequest->getEpisode()->getReleaseDate() : "");
        $episodeEntity->setSeason($seasonEntity);
        $episodeEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $episodeEntity;
    }
}