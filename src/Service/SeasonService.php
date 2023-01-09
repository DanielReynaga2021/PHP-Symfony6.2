<?php

namespace App\Service;

use App\Entity\Director;
use App\Entity\Season;
use App\Entity\Tv;
use App\Enum\ExceptionEnum;
use App\Model\Request\DataShowRequest;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


class SeasonService implements IDataShowInterface{

    /**
     * @var EntityManagerInterface
    */
    private $em;

    /**
     * @var TvService
    */
    private $tvService;
    function __construct(
        EntityManagerInterface $em,
        TvService $tvService, 
    )
    {
        $this->em = $em;
        $this->tvService = $tvService;  
    }

    public function addDataShow(DataShowRequest $dataShowRequest){
        $tvId = $dataShowRequest->getSeason()->getTvId();
        if(!$tvId){
            throw new BadRequestHttpException(ExceptionEnum::EMPTY);
        }
        $tvEntity = $this->tvService->getTvShow($tvId);
        $seasonEntity = $this->builDataShow($dataShowRequest, $tvEntity);
        $this->em->persist($seasonEntity);
        $this->em->flush();
    }

    private function builDataShow(DataShowRequest $dataShowRequest, Tv $tvEntity){
        $seasonEntity = new Season();
        $seasonEntity->setNumberSeason($dataShowRequest->getSeason()->getNumberSeason()?$dataShowRequest->getSeason()->getNumberSeason(): 0);
        $seasonEntity->setReleaseDate($dataShowRequest->getSeason()->getReleaseDate() ? $dataShowRequest->getSeason()->getReleaseDate() : "");
        $seasonEntity->setTv($tvEntity);
        $seasonEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $seasonEntity;
    }

    public function getSeason(int $seasonId){
        $seasonEntity = $this->em->getRepository(Season::class)->find($seasonId);
        if(!$seasonEntity){
            throw new NotFoundResourceException(ExceptionEnum::INVALID_SEASON);
        }
        return $seasonEntity;
    }

}