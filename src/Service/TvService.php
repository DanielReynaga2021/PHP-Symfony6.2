<?php

namespace App\Service;

use App\Entity\Director;
use App\Entity\Tv;
use App\Model\Request\DataShowRequest;
use App\Service\DataShow\IDataShowInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;


class TvService implements IDataShowInterface{

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

    public function addDataShow(DataShowRequest $dataShowRequest){
        $directorId = $dataShowRequest->getTv()->getDirectorId();
        if(!$directorId){
            throw new BadRequestHttpException('The attribute is required');
        }
        $directorEntity = $this->directorService->getDirector($directorId);
        $userEntity = $this->builDataShow($dataShowRequest, $directorEntity);
        $this->em->persist($userEntity);
        $this->em->flush();
    }

    private function builDataShow(DataShowRequest $dataShowRequest, Director $directorEntity){
        $tvEntity = new Tv();
        $tvEntity->setName($dataShowRequest->getTv()->getName()?$dataShowRequest->getTv()->getName(): "");
        $tvEntity->setReleaseDate($dataShowRequest->getTv()->getReleaseDate() ? $dataShowRequest->getTv()->getReleaseDate() : "");
        $tvEntity->setDirector($directorEntity);
        $tvEntity->setCreatedAt(date('d/m/y h:i:s'));
        return $tvEntity;
    }

    public function getTvShow(int $id){
        $tv = $this->em->getRepository(Tv::class)->find($id);
        if(!$tv){
            throw new NotFoundResourceException("Not found in the database");
        }
        return $tv;
    }
}